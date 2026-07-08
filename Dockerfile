# Stage 1: Build frontend assets
FROM node:20-alpine AS frontend
WORKDIR /app
COPY package.json package-lock.json vite.config.js ./
RUN npm ci
COPY resources ./resources
COPY public ./public
RUN npm run build

# Stage 2: Create application runtime
FROM php:8.3-fpm-alpine
WORKDIR /app

# Install system dependencies
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    bash

# Install PHP extensions helper and required extensions
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions gd pdo_mysql mbstring zip xml bcmath pcntl opcache

# Configure PHP settings
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

RUN { \
        echo 'opcache.enable=1'; \
        echo 'opcache.enable_cli=1'; \
        echo 'opcache.memory_consumption=256'; \
        echo 'opcache.interned_strings_buffer=16'; \
        echo 'opcache.max_accelerated_files=20000'; \
        echo 'opcache.revalidate_freq=0'; \
        echo 'opcache.validate_timestamps=0'; \
        echo 'opcache.save_comments=1'; \
        echo 'opcache.fast_shutdown=1'; \
    } > /usr/local/etc/php/conf.d/opcache-recommended.ini

RUN { \
        echo 'upload_max_filesize = 64M'; \
        echo 'post_max_size = 64M'; \
        echo 'memory_limit = 256M'; \
        echo 'max_execution_time = 60'; \
    } > /usr/local/etc/php/conf.d/custom-php.ini

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy only composer configuration first for package caching
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# Copy the rest of the application files
COPY . .

# Copy built frontend assets from the frontend build stage
COPY --from=frontend /app/public/build ./public/build

# Finalize composer autoloader optimization
RUN composer dump-autoload --optimize --no-dev

# Configure Nginx and Supervisor
COPY .docker/nginx.conf /etc/nginx/http.d/default.conf
RUN sed -i 's/user nginx;/user www-data;/g' /etc/nginx/nginx.conf
COPY .docker/supervisor.conf /etc/supervisor/conf.d/supervisord.conf

# Ensure entrypoint script is executable and has LF line endings
RUN sed -i 's/\r$//' /app/.docker/entrypoint.sh \
    && chmod +x /app/.docker/entrypoint.sh

# Create runtime directories and set ownership
RUN mkdir -p /run/nginx /var/log/supervisor /var/spool/cron/crontabs \
    && chown -R www-data:www-data /app

EXPOSE 80

ENTRYPOINT ["/app/.docker/entrypoint.sh"]
