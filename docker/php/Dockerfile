FROM php:8.4-fpm-bullseye AS base

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

WORKDIR /var/www/html


RUN install-php-extensions  \
    @composer  \
    pdo_mysql  \
    opcache  \
    redis  \
    intl  \
    soap  \
    bcmath  \
    gd  \
    zip  \
    pcntl  \
    igbinary  \
    xdebug && \
    apt clean && \
    rm -rf /var/lib/apt/lists/*

RUN apt update  && \
    apt install git -y && \
    apt clean && \
    rm -rf /var/lib/apt/lists/* && \
    cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini


FROM base AS dev

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

FROM base AS ci

COPY --chown=www-data:www-data . /var/www/html

RUN su www-data -s /bin/sh -c "APP_ENV=dev composer install --no-interaction --optimize-autoloader"
