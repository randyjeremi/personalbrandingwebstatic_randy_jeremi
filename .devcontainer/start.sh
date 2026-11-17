#!/usr/bin/env bash
# Jalankan server Laravel di latar belakang setiap kali Codespace menyala.
# Log server bisa dilihat dengan: tail -f /tmp/laravel-serve.log

if pgrep -f "artisan serve" > /dev/null; then
    echo "Server Laravel sudah berjalan."
    exit 0
fi

setsid nohup php artisan serve --host=0.0.0.0 --port=8000 > /tmp/laravel-serve.log 2>&1 &
echo "Server Laravel berjalan di port 8000."
