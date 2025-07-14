FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libonig-dev libxml2-dev \
    libpng-dev libjpeg-dev libfreetype6-dev \
    cron nano

RUN docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
