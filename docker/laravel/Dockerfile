FROM php:7.4-fpm

  # locale
ENV LANG=ja_JP.UTF-8 \
  LC_CTYPE=ja_JP.UTF-8 \
  # composer environment
  COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer \
  PATH=$PATH:/composer/vendor/bin

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apt-get update && \
  apt-get -y install git libicu-dev libonig-dev libmcrypt-dev zlib1g-dev libzip-dev unzip nano default-mysql-client apt-transport-https locales && \
  apt-get clean && \
  rm -rf /var/lib/apt/lists/* && \
  locale-gen ja_JP.UTF-8 && \
  localedef -f UTF-8 -i ja_JP ja_JP.utf8 && \
  docker-php-ext-install intl pdo_mysql zip bcmath mysqli

COPY ./php.ini /etc/php/php.ini

WORKDIR /var/www/html

ADD ./docker-entrypoint.sh /tmp
ENTRYPOINT ["/tmp/docker-entrypoint.sh"]
CMD [ "/sbin/init" ]
