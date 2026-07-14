<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

/**
 * Handles ASTPP BF-ECB password encryption/decryption
 * for customer authentication.
 */
class CustomerAuthService
{
    protected string $privateKey;

    public function __construct()
    {
        $this->privateKey = config('astpp.private_key', '8YSDaBtDHAB3EQkxPAyTz2I5DttzA9uR');
    }

    /**
     * Encrypt a password using ASTPP's BF-ECB method
     */
    public function encode(string $value): string
    {
        $ivSize = openssl_cipher_iv_length('BF-ECB');
        $iv = ($ivSize > 0) ? openssl_random_pseudo_bytes($ivSize) : false;
        $encrypted = openssl_encrypt($value, 'BF-ECB', $this->privateKey, OPENSSL_RAW_DATA, $iv);
        $encoded = base64_encode($encrypted);
        return str_replace(['+', '/', '='], ['-', '$', ''], $encoded);
    }

    /**
     * Decrypt a password stored in ASTPP DB
     */
    public function decode(string $encoded): string
    {
        $data = str_replace(['-', '$'], ['+', '/'], $encoded);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        $data = base64_decode($data);
        $ivSize = openssl_cipher_iv_length('BF-ECB');
        $iv = ($ivSize > 0) ? openssl_random_pseudo_bytes($ivSize) : false;
        return (string) openssl_decrypt($data, 'BF-ECB', $this->privateKey, OPENSSL_RAW_DATA, $iv);
    }

    /**
     * Verify a plain password against ASTPP stored password
     */
    public function verify(string $plainPassword, string $storedPassword): bool
    {
        $encoded = $this->encode($plainPassword);
        return $encoded === $storedPassword;
    }

    /**
     * Find account by number or email and verify password
     */
    public function attempt(string $login, string $password): ?object
    {
        $account = DB::table('accounts')
            ->where(function($q) use ($login) {
                $q->where('number', $login)->orWhere('email', $login);
            })
            ->where('status', 0)
            ->where('deleted', 0)
            ->whereIn('type', [0, 1, 3]) // customer, reseller
            ->first();

        if (!$account) return null;

        $storedEncoded = $this->encode($password);
        if ($storedEncoded !== $account->password) return null;

        return $account;
    }
}
