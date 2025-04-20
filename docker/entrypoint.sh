#!/bin/sh

echo "📦 Installing dependencies..."
composer install --no-interaction --prefer-dist --optimize-autoloader

echo "🔧 Caching config..."
php artisan config:clear
php artisan config:cache

echo "🚀 Running migrations..."
php artisan migrate --force

echo "🌱 Running seeders..."
php artisan db:seed --force

echo "✅ Done! Starting PHP-FPM..."
exec php-fpm
