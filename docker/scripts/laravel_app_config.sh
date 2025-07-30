#!/bin/sh

wait-for-it.sh mysql:3306 --timeout=60 --strict -- 

cd /var/www/html/${PROJECT}

if [ ! -d "vendor" ]; then
  composer install --no-interaction --prefer-dist --optimize-autoloader
fi

php artisan migrate --force --no-interaction

exec php-fpm
