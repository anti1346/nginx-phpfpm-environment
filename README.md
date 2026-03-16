# nginx-phpfpm-environment
nginx php-fpm development environment for docker container

```
docker exec -it laravel-app sh -c "cat <<'EOF' > /var/www/public/test.html
<h1>Container Test</h1>
EOF"
```
```
docker compose exec php-fpm /bin/sh
```
```
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
```
```
docker compose exec php-fpm composer create-project --prefer-dist laravel/laravel .
```
```
docker compose exec php-fpm php artisan route:clear
docker compose exec php-fpm php artisan config:clear
docker compose exec php-fpm php artisan cache:clear
```
```
docker compose exec php-fpm php artisan route:list
```
```
docker compose exec php-fpm chown -R www-data:www-data storage bootstrap/cache
```
```
vim www/.env
REDIS_CLIENT=phpredis
REDIS_HOST=redis-node-1
REDIS_PASSWORD=redis_password
REDIS_PORT=7001
```