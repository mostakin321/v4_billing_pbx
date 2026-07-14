<?php
// Add this inside config/database.php -> connections array.
'astpp' => [
    'driver' => 'mysql',
    'host' => env('ASTPP_DB_HOST', '127.0.0.1'),
    'port' => env('ASTPP_DB_PORT', '3306'),
    'database' => env('ASTPP_DB_DATABASE', 'astpp'),
    'username' => env('ASTPP_DB_USERNAME', 'astppuser'),
    'password' => env('ASTPP_DB_PASSWORD', ''),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
    'strict' => false,
    'engine' => null,
],
