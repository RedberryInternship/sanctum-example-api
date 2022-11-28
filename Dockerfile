FROM composer:2.2.9 as VendorBuild

WORKDIR /app

COPY composer.json ./
COPY composer.lock ./
COPY auth.json ./

RUN composer install --no-autoloader

COPY . ./

RUN composer dump-autoload

FROM php:8.1-cli

RUN apt-get update && apt-get install vim htop -y
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN pecl install swoole
RUN pecl install -o -f redis && rm -rf /tmp/pear && docker-php-ext-enable redis

RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
RUN echo "extension=swoole.so" >> /usr/local/etc/php/php.ini

WORKDIR /app

COPY --from=VendorBuild ./app .

EXPOSE 8000

CMD [ "php", "artisan", "octane:start", "--host=0.0.0.0"]