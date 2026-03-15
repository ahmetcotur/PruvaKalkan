#!/bin/sh

# Create storage link if it doesn't exist
php artisan storage:link --force

# Clear and cache config/routes
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start Nginx in background
nginx

# Start PHP-FPM
php-fpm
