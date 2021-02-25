FROM php:7.4.15-fpm-buster

LABEL maintainer="Satake Ryota=<satake00157@gmail.com> \
    Hisashi SOGA=<sogaoh@ant-in-giant.work>" \
    description="Laravel用のDockerfile"

# locale
ENV LANG=ja_JP.UTF-8 \
    LC_CTYPE=ja_JP.UTF-8 \
    # composer environment
    COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/composer \
    PATH=$PATH:/composer/vendor/bin

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apt-get update && \
    apt-get -y install git libicu-dev libonig-dev libmcrypt-dev zlib1g-dev libzip-dev unzip nano default-mysql-client apt-transport-https locales procps && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* && \
    locale-gen ja_JP.UTF-8 && \
    localedef -f UTF-8 -i ja_JP ja_JP.utf8 && \
    docker-php-ext-install intl pdo_mysql zip bcmath mysqli

# phpファイルを転送
ADD ./php.ini /usr/local/etc/php/php.ini

#log作成
RUN touch /usr/local/etc/php-fpm.d/fpm-php.www.log

WORKDIR /var/www/html

ADD ./docker-entrypoint.sh /tmp
ENTRYPOINT ["/tmp/docker-entrypoint.sh"]
CMD [ "/sbin/init" ]
