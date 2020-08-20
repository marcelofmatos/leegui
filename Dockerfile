FROM php:7.4-fpm

# Arguments defined in docker-compose.yml
ARG user=www-data
ARG uid=1000

# Install system dependencies
RUN apt-get update \
    && apt-get install -y \
        curl \
        git \
        libpng-dev \
        libldap2-dev \
        libonig-dev \
        libxml2-dev \
        libsqlite3-dev \
        unzip \
        zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_sqlite mbstring exif pcntl bcmath gd ldap

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY --chown=www-data:www-data . /var/www/html/

# Set working directory
WORKDIR /var/www/html

#ENTRYPOINT /var/www/html/entrypoint.sh