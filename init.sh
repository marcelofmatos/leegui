composer self-update --1
composer install
if [ ! -f .env ]; then
  cp .env.example .env
fi