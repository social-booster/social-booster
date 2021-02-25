#!/bin/sh

# Laravelのcomposerによる最初のインストール
composer self-update
composer validate
composer install

# composer install後に生成させるファイルのファイル権限の変更
chmod -R 777 bootstrap/cache
chmod -R 777 storage

# logファイルの書き込み権限を付与
chmod -R 777 /work/storage

# DBのマイグレート
composer dump-autoload
php artisan migrate

# php-fpmをずっとフォアグラウンドで実行させる
php-fpm
