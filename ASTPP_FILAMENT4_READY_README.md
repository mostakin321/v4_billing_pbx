# Kazitel ASTPP Laravel 12 + Filament 4 Ready Package

This package is a full Laravel project with the fresh ASTPP model/resource overlay applied.

Important:
- ASTPP remains the owner of the real `astpp` database.
- Laravel connects to ASTPP via the `astpp` DB connection.
- Do not run Laravel migrations on the ASTPP database.
- Old hand-written Billing resources were moved to `_disabled_old_filament_resources/Billing` to avoid Filament 4 resource conflicts.
- New resources are under `app/Filament/Resources/Astpp` and depend on `app/Models/Astpp`.
- Filament public assets are present under `public/js`, `public/css`, `public/fonts`, and also copied to `public/vendor/filament` as a compatibility fallback.

Required .env:

```env
ASTPP_DB_HOST=127.0.0.1
ASTPP_DB_PORT=3306
ASTPP_DB_DATABASE=astpp
ASTPP_DB_USERNAME=astppuser
ASTPP_DB_PASSWORD="YOUR_ASTPP_DB_PASSWORD"
```

After uploading to server:

```bash
cd /var/www/kazitel
bash INSTALL_ASTPP_FILAMENT4_OVERLAY.sh
```

Test ASTPP DB from Laravel:

```bash
php8.2 artisan tinker
DB::connection('astpp')->table('accounts')->limit(1)->get();
```
