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

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy app files
COPY . /build

# Install dependencies
RUN composer install --no-dev --no-interaction --no-progress --optimize-autoloader

# Production stage
FROM php:8.2-fpm

WORKDIR /app

# Install runtime dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    curl \
    libpq5 \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions for production
RUN docker-php-ext-install pdo pdo_mysql

# Copy PHP-FPM config
COPY docker/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY docker/php.ini /usr/local/etc/php/conf.d/app.ini

# Copy Nginx config
COPY docker/nginx.conf /etc/nginx/sites-available/default

# Copy built app from builder
COPY --from=builder /build /app

# Create necessary directories with permissions
RUN mkdir -p /app/storage/logs /app/storage/framework/cache /app/storage/framework/views \
    && chown -R www-data:www-data /app \
    && chmod -R 775 /app/storage /app/bootstrap/cache

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 \
    CMD curl -f http://localhost/api/v1/portfolio || exit 1

# Expose port
EXPOSE 8080

# Start services
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
