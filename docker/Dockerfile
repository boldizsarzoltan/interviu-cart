# Use the official PHP image as the base image
FROM php:8.3-alpine

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/proiect

ADD ../src /var/www/proiect/src
COPY ../composer.json ./composer.json
COPY ../index.php ./index.php

RUN composer install
CMD ["php", "index.php"]