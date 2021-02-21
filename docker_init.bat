@echo on
rem mysqlのログフォルダ作成
cd docker\mysql
mkdir db
mkdir logs

rem mysqlのログファイル作成
cd logs
echo "">mysqld.log
echo "">mysql-error.log

rem nginxのログフォルダ作成
cd ..\..\nginx
mkdir logs

rem nginxのログファイル作成
cd logs
echo "">access.log
echo "">error.log

PAUSE
