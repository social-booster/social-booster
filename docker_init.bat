@echo on
rem mysql�̃��O�t�H���_�쐬
cd docker\mysql
mkdir db
mkdir logs

rem mysql�̃��O�t�@�C���쐬
cd logs
echo "">mysqld.log
echo "">mysql-error.log

rem nginx�̃��O�t�H���_�쐬
cd ..\..\nginx
mkdir logs

rem nginx�̃��O�t�@�C���쐬
cd logs
echo "">access.log
echo "">error.log

PAUSE
