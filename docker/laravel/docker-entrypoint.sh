#!/bin/sh

# Laravelのcomposerによる最初のインストール
composer self-update
composer validate
composer install

# composer install後に生成させるファイルのファイル権限の変更
chmod -R 777 bootstrap/cache
chmod -R 777 storage

# DBのマイグレート
composer dump-autoload
php artisan migrate

# Laravelをバックグラウンドで処理させる
nohup php artisan serve &

# php-fpmをずっとフォアグラウンドで実行させる
php-fpm
