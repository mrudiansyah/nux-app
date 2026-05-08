# ==========================================
# DOCKERFILE APACHE (WITH NODE.JS FOR ASSETS)
# ==========================================
FROM php:8.4-apache

# Install tool pembantu ekstensi PHP
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

# Install sistem dependencies & Node.js
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libzip-dev \
    libxml2-dev \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install ekstensi PHP
RUN install-php-extensions \
    pdo_mysql sqlsrv pdo_sqlsrv gd zip intl dom xml simplexml fileinfo session bcmath exif pcntl

# Aktifkan mod_rewrite
RUN a2enmod rewrite

# Setup Document Root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . /var/www/html

# Install PHP dependencies (Force fresh resolution because local lock file is broken)
RUN rm -f composer.lock && COMPOSER_MEMORY_LIMIT=-1 composer install --no-interaction --optimize-autoloader --no-dev --ignore-platform-reqs --no-scripts

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
CMD ["apache2-foreground"]
