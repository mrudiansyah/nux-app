# ==========================================
# DOCKERFILE APACHE (DEBIAN VERSION - STABLE)
# ==========================================
FROM php:8.4-apache

# Install tool pembantu ekstensi PHP
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

# Install sistem dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libzip-dev \
    libxml2-dev \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install ekstensi PHP (Lengkap untuk Laravel)
RUN install-php-extensions \
    pdo_mysql sqlsrv pdo_sqlsrv gd zip intl dom xml simplexml fileinfo session bcmath exif pcntl

# Aktifkan mod_rewrite untuk Laravel
RUN a2enmod rewrite

# Setup Document Root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . /var/www/html

# Install dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev --ignore-platform-reqs

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Gunakan port 80
EXPOSE 80
