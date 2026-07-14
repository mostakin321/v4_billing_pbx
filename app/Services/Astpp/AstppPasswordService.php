<?php

namespace App\Services\Astpp;

class AstppPasswordService
{
    public static function encode(string $plainText, ?string $privateKey = null): string
    {
        $privateKey ??= self::privateKeyFromConfig();
        $ivSize = openssl_cipher_iv_length('BF-ECB');
        $iv = $ivSize > 0 ? openssl_random_pseudo_bytes($ivSize) : false;
        $encrypted = openssl_encrypt($plainText, 'BF-ECB', $privateKey, OPENSSL_RAW_DATA, $iv);

        return str_replace(['+', '/', '='], ['-', '$', ''], base64_encode((string) $encrypted));
    }

    public static function privateKeyFromConfig(): string
    {
        $path = env('ASTPP_CONFIG_PATH', '/var/lib/astpp/astpp-config.conf');
        $config = is_file($path) ? parse_ini_file($path) : [];

        return trim((string) ($config['PRIVATE_KEY'] ?? env('ASTPP_PRIVATE_KEY', '')), ""'");
    }
}
