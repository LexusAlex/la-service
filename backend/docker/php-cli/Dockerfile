FROM php:8.1-cli

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

RUN addgroup --gid 1000 la-service && adduser --uid 1000 --ingroup la-service -shell /bin/bash --disabled-password la-service

RUN apt update && apt install -y unzip

RUN apt -y update \
    && docker-php-ext-install pdo_mysql \
    && apt clean

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

WORKDIR /la-service

USER la-service