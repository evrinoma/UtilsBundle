#/!bin/bash

LOG_FILE_NAME=$1
if [ -z "$LOG_FILE_NAME" ]; then
	LOG_FILE_NAME='test.dump'
fi;
log=/tmp/$LOG_FILE_NAME
echo > $log

rm -rf vendor
rm -rf composer.lock
COMPOSER_NO_DEV=0 composer install
