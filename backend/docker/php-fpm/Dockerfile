FROM php:8.1-fpm

RUN apt -y update \
    && docker-php-ext-install pdo_mysql \
    && apt clean

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

WORKDIR /la-service