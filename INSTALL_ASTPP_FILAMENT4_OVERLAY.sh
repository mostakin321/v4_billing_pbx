#!/usr/bin/env bash
set -euo pipefail
cd "$(dirname "$0")"

PHP_BIN="${PHP_BIN:-php8.2}"
if ! command -v "$PHP_BIN" >/dev/null 2>&1; then
  PHP_BIN="php"
fi

# Keep ASTPP DB external. Do not migrate the ASTPP DB.
$PHP_BIN artisan optimize:clear || true
$PHP_BIN artisan filament:upgrade || true
$PHP_BIN artisan vendor:publish --tag=filament-assets --force || true
$PHP_BIN artisan config:clear || true
$PHP_BIN artisan route:clear || true
$PHP_BIN artisan view:clear || true
$PHP_BIN artisan cache:clear || true

chown -R www-data:www-data storage bootstrap/cache public 2>/dev/null || true
chmod -R 775 storage bootstrap/cache 2>/dev/null || true

echo "Done. Open /admin"
