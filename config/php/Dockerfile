FROM php:8.3.3RC1-fpm-alpine3.18

RUN printf 'date.timezone = "Europe/Warsaw"' > /usr/local/etc/php/conf.d/tzone.ini

RUN apk --no-cache add \
    $PHPIZE_DEPS \
    git \
    postgresql-dev \
    && pecl install redis-5.3.7

RUN docker-php-ext-install pgsql pdo_pgsql pdo intl \
    && docker-php-ext-enable redis

RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer
COPY symfony /var/www/symfony
WORKDIR /var/www/symfony