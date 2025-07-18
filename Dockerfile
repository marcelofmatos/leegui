# Otimized Dockerfile for faster builds
# Build stage - Using Ubuntu for pre-compiled extensions
FROM php:7.4-fpm AS builder

# Install system dependencies in single layer
RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    sqlite3 \
    libsqlite3-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions (much faster on Ubuntu)
RUN docker-php-ext-install -j$(nproc) \
    pdo_sqlite \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd

# Install Composer 2
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy and install dependencies first (better caching)
COPY composer.json composer.lock ./
ENV COMPOSER_MEMORY_LIMIT=-1
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# Copy application files
COPY . .

# Generate optimized autoload
RUN composer dump-autoload --optimize --no-scripts

# Production stage - Minimal runtime
FROM php:7.4-fpm

# Install only runtime dependencies
RUN apt-get update && apt-get install -y \
    libpng16-16 \
    libonig5 \
    sqlite3 \
    libsqlite3-0 \
    && rm -rf /var/lib/apt/lists/*

# Copy PHP extensions from builder
COPY --from=builder /usr/local/lib/php/extensions/ /usr/local/lib/php/extensions/
COPY --from=builder /usr/local/etc/php/conf.d/ /usr/local/etc/php/conf.d/

# Create user
RUN groupadd -g 1000 www && useradd -u 1000 -g www -s /bin/bash www

# Copy application from builder
COPY --from=builder --chown=www:www /var/www/html /var/www/html

WORKDIR /var/www/html

# Setup permissions
RUN mkdir -p storage/logs storage/framework/cache storage/framework/sessions storage/framework/views \
    && chown -R www:www storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

USER www

EXPOSE 9000

CMD ["php-fpm"]
