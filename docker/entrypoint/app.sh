#!/bin/sh
set -e

cd /var/www

if [ -f artisan ] && [ -d vendor ]; then
    # Keep Laravel writable dirs available on bind mounts in dev.
    mkdir -p storage/framework/{cache,sessions,testing,views} bootstrap/cache
    chmod -R ug+rwX,o+rwX storage bootstrap/cache >/dev/null 2>&1 || true

    if [ -d storage/app/public ]; then
        if [ ! -L public/storage ] || [ ! -e public/storage ]; then
            rm -rf public/storage
            ln -s ../storage/app/public public/storage
        fi
    fi

    if [ "${APP_ENV}" = "production" ]; then
        php artisan config:cache || true
        php artisan route:cache || true
        php artisan view:cache || true
    else
        php artisan config:clear >/dev/null 2>&1 || true
    fi
fi

exec "$@"
