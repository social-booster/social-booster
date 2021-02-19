#!/bin/sh

composer self-update
composer validate
composer install

chmod -R 777 ./bootstrap/cache
chmod -R 777 ./storage

adduser -o -m nginx
chown -R nginx:nginx .*

composer dump-autoload
php artisan migrate

php artisan serve
