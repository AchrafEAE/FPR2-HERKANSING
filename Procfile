release: php artisan migrate --force
web: php artisan optimize:clear && php artisan config:cache && php artisan serve --host=0.0.0.0 --port=$PORT
