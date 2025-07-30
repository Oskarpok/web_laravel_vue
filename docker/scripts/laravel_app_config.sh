#!/bin/sh

wait-for-it.sh mysql:3306 --timeout=60 --strict -- 

cd /var/www/html/${PROJECT}
php artisan migrate --force --no-interaction

exec php-fpm
