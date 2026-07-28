#!/usr/bin/env bash
set -euo pipefail

PORT="${PORT:-10000}"
export PORT

if [ -z "${APP_KEY:-}" ]; then
    echo "ERROR: APP_KEY is not set. Set a persistent Laravel APP_KEY in Render before deploying." >&2
    exit 1
fi

if [ -z "${APP_URL:-}" ] && [ -n "${RENDER_EXTERNAL_HOSTNAME:-}" ]; then
    export APP_URL="https://${RENDER_EXTERNAL_HOSTNAME}"
fi

mkdir -p \
    storage/app/public \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/testing \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

chown -R www-data:www-data storage bootstrap/cache
chmod -R ug+rwX storage bootstrap/cache

sed -ri "s/^Listen .*/Listen ${PORT}/" /etc/apache2/ports.conf
sed -ri "s/<VirtualHost \*:[0-9]+>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

run_as_www_data() {
    su -s /bin/sh www-data -c "$*"
}

run_as_www_data "php artisan storage:link --force --ansi" || true

run_as_www_data "php artisan config:clear --ansi"
run_as_www_data "php artisan route:clear --ansi"
run_as_www_data "php artisan view:clear --ansi"

run_as_www_data "php artisan config:cache --ansi"
run_as_www_data "php artisan view:cache --ansi"

if run_as_www_data "php artisan route:cache --ansi"; then
    echo "Laravel routes cached."
else
    echo "Laravel route cache skipped because the current route files contain closure routes." >&2
    run_as_www_data "php artisan route:clear --ansi" || true
fi

exec apache2-foreground
