#!/usr/bin/env bash
# Persiapan sekali jalan saat Codespace pertama kali dibuat.
set -e

composer install --no-interaction --prefer-dist --no-progress

if [ ! -f .env ]; then
    cp .env.example .env
fi

# Website tidak memakai database: session & cache disimpan sebagai file.
sed -i 's/^CACHE_STORE=database/CACHE_STORE=file/; s/^SESSION_DRIVER=database/SESSION_DRIVER=file/' .env

# Buat APP_KEY hanya jika belum ada.
if ! grep -q '^APP_KEY=base64:' .env; then
    php artisan key:generate --no-interaction
fi

php artisan optimize:clear
echo "Setup selesai. Server akan berjalan di port 8000."
