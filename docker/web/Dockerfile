FROM php:7.4-apache

RUN docker-php-ext-install \
    pdo_mysql \
    && a2enmod \
    rewrite

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get update && apt-get install -y git

RUN groupmod -g 1000 www-data && usermod -u 1000 -g 1000 www-data
