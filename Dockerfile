FROM php:8.0.0-fpm

COPY install-composer.sh /
COPY ./docker/php/php.ini /usr/local/etc/php/

RUN apt-get update \
    && apt-get install -y wget git unzip libpq-dev vim \
#    && curl -sL https://deb.nodesource.com/setup_12.x | bash - \
#    && apt-get install -y nodejs \
    && docker-php-ext-install -j$(nproc) pdo_pgsql \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && chmod 755 /install-composer.sh \
    && /install-composer.sh \
    && mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/html