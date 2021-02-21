#!/bin/sh

# mysqlのログフォルダ作成
cd docker\mysql
mkdir db
mkdir logs

# mysqlのログファイル作成
cd logs
touch mysqld.log
touch mysql-error.log

# nginxのログフォルダ作成
cd ..\..\nginx
mkdir logs

# nginxのログファイル作成
cd logs
touch access.log
touch error.log
