composer install
# Clear Laravel package discovery cache
php artisan package:discover --ansi || echo "Package discovery failed, continuing..."
if [ ! -f .env ]; then
  cp .env.example .env
fi