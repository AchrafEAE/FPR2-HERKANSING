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
FROM php:8.2-apache

WORKDIR /var/www/html

# Install PHP extensions for production
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite for Laravel routing
RUN a2enmod rewrite

# Change Apache DocumentRoot to Laravel's public directory
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy built app from builder
COPY --from=builder /build /var/www/html

# Create necessary directories with permissions
RUN mkdir -p /var/www/html/storage/logs /var/www/html/storage/framework/cache /var/www/html/storage/framework/views \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Configure Apache to listen on $PORT dynamically and start in the foreground
CMD ["sh", "-c", "sed -i 's/Listen 80/Listen '${PORT:-8080}'/g' /etc/apache2/ports.conf && sed -i 's/VirtualHost \\*:80/VirtualHost \\*:'${PORT:-8080}'/g' /etc/apache2/sites-available/*.conf && apache2-foreground"]


