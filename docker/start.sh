#!/bin/sh
# Dijalankan setiap kali server di Render menyala.
set -e

# APP_KEY sebaiknya diisi di Environment Render. Jika kosong, buat sementara
# supaya website tetap bisa jalan (session lama akan hilang saat server restart).
if [ -z "$APP_KEY" ]; then
    echo "APP_KEY belum diisi, membuat key sementara..."
    APP_KEY="$(php artisan key:generate --show --no-ansi)"
    export APP_KEY
fi

# Simpan config, route, dan view ke cache supaya lebih cepat.
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Jalankan server Laravel di port yang diberikan Render.
exec php artisan serve --host=0.0.0.0 --port="${PORT:-8080}" --no-reload
