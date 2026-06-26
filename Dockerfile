# Multi-stage Dockerfile for Laravel 12 Portfolio App
# Build stage: compile dependencies and run quality checks
# Production stage: minimal image with only runtime dependencies

FROM php:8.2-cli AS builder

WORKDIR /build

# Install build dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# Install Node.js LTS
RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy app files
COPY . /build

# Install PHP dependencies
RUN composer install --no-dev --no-interaction --no-progress --optimize-autoloader

# Install Node dependencies and compile Vite assets
RUN npm install && npm run build

# Production stage
FROM php:8.2-fpm

WORKDIR /app

# Install runtime dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    curl \
    gettext-base \
    libpq5 \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions for production
RUN docker-php-ext-install pdo pdo_mysql

# Copy PHP-FPM config
COPY docker/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY docker/php.ini /usr/local/etc/php/conf.d/app.ini

# Copy Nginx config
# Copy Nginx config template
COPY docker/nginx.conf /etc/nginx/sites-available/default.template

# Copy built app from builder
COPY --from=builder /build /app

# Copy compiled Vite assets into production image
COPY --from=builder /build/public/build /app/public/build

# Create necessary directories with permissions
RUN mkdir -p /app/storage/logs /app/storage/framework/cache /app/storage/framework/views /app/storage/app/public/avatars \
    && chown -R www-data:www-data /app \
    && chmod -R 775 /app/storage /app/bootstrap/cache \
    && chmod -R 755 /app/public/build

# Create storage symlink so uploaded files are publicly accessible
RUN ln -sf /app/storage/app/public /app/public/storage

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 \
    CMD sh -c 'curl -f http://localhost:${PORT:-8080}/api/v1/portfolio || exit 1'

# Expose port
EXPOSE 8080

# Start services
CMD ["sh", "-c", "export PORT=${PORT:-8080}; envsubst '$PORT' < /etc/nginx/sites-available/default.template > /etc/nginx/sites-available/default && php-fpm -D && nginx -g 'daemon off;'"]
