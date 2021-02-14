FROM php:7.4-fpm-buster

ENV TZ='Asia/Toyko'
# composer environment
ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/composer

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

RUN apt-get update && \
    apt-get -y install git libicu-dev libonig-dev libzip-dev unzip locales vim && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* && \
    locale-gen ja_JP.UTF-8 && \
    localedef -f UTF-8 -i ja_JP ja_JP.UTF-8 && \
    mkdir /var/run/php-fpm && \
    docker-php-ext-install intl pdo_mysql zip bcmath && \
    composer config -g process-timeout 3600 && \
    composer config -g repos.packagist composer https://packagist.org

COPY ./docker/php/php-fpm.d/zzz-www.conf /usr/local/etc/php-fpm.d/zzz-www.conf
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

WORKDIR /var/www/html

ADD . .

RUN composer self-update
RUN composer validate
RUN composer install

RUN bash -c "chmod -R 777 ./bootstrap/cache" && "chmod -R 777 ./storage"

RUN composer dump-autoload
RUN php artisan migrate
