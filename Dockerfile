# ============================================================
# Image untuk menjalankan website di hosting (Render).
# Tahap 1: install dependency PHP dengan Composer.
# Tahap 2: image PHP ringan yang menjalankan Laravel.
# ============================================================

FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --no-interaction --no-progress
COPY . .
RUN composer dump-autoload --optimize --no-dev --no-scripts

FROM php:8.4-cli-alpine
WORKDIR /var/www/html

COPY --from=vendor /app /var/www/html

# Folder yang harus bisa ditulis Laravel (session, cache view, log).
RUN mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache/data storage/logs bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && php artisan package:discover --ansi \
    && chmod +x docker/start.sh

ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    SESSION_DRIVER=file \
    CACHE_STORE=file \
    PORT=8080

EXPOSE 8080

CMD ["sh", "docker/start.sh"]
