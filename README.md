# ASTPP Laravel 12 + Filament 4 Fresh Overlay

Generated from the uploaded ASTPP schema on 2026-06-06T19:26:59.885607+00:00.

## Contents

- Models for all 69 ASTPP tables in `app/Models/Astpp`.
- Filament 4 resources for all tables in `app/Filament/Resources/Astpp`.
- `SipProfile` and `SipDevice` models/resources included.
- `AstppPasswordService` for ASTPP-compatible encoded passwords.
- Optional replacement `AdminPanelProvider.php` that discovers resources automatically.

## Install

Copy the overlay into your Laravel 12 project root:

```bash
unzip astpp_laravel12_filament4_fresh_overlay.zip -d /tmp/astpp-overlay
cp -r /tmp/astpp-overlay/* /var/www/kazitel-ui/
cd /var/www/kazitel-ui
composer dump-autoload
php artisan optimize:clear
```

Add the `astpp` connection from `config/astpp-database-snippet.php` into `config/database.php`.

Add `.env` values from `config/env-example.txt`.

## Important

Do not run Laravel migrations on the live ASTPP database. Start read-only, then carefully enable writes table-by-table.

Relationships are inferred from ASTPP legacy field names because the schema has few explicit foreign keys.
