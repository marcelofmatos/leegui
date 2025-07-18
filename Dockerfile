# Build stage
FROM php:7.4-fpm-alpine AS builder

# Install build dependencies
RUN apk add --no-cache \
    curl \
    git \
    unzip \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    sqlite-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_sqlite mbstring exif pcntl bcmath gd

# Install Composer 1
COPY --from=composer:1 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy composer.json only
COPY composer.json ./

# Install dependencies with minimal memory
ENV COMPOSER_MEMORY_LIMIT=-1
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --ignore-platform-reqs

# Copy application files
COPY . .

# Apply PackageManifest fix and generate autoloader
COPY fix-packagemanifest.sh ./
RUN chmod +x fix-packagemanifest.sh \
    && ./fix-packagemanifest.sh \
    && composer dump-autoload --optimize

# Production stage
FROM php:7.4-fpm-alpine

# Install runtime dependencies
RUN apk add --no-cache \
    libpng \
    oniguruma \
    sqlite \
    nginx \
    supervisor

# Install PHP extensions
RUN docker-php-ext-install pdo_sqlite mbstring exif pcntl bcmath gd

# Create user
RUN addgroup -g 1000 -S www && \
    adduser -u 1000 -S www -G www

# Copy from builder
COPY --from=builder --chown=www:www /var/www/html /var/www/html

# Set working directory
WORKDIR /var/www/html

# Create necessary directories
RUN mkdir -p storage/logs storage/framework/cache storage/framework/sessions storage/framework/views \
    && chown -R www:www storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Switch to non-root user
USER www

EXPOSE 9000

CMD ["php-fpm"]
