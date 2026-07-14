<?php
namespace App\Models;

use App\Services\CustomerAuthService;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Notifications\Notifiable;

/**
 * Customer model — reads from astpp.accounts table.
 * Uses ASTPP BF-ECB password encryption.
 */
class Customer extends Model implements AuthenticatableContract, FilamentUser
{
    use Authenticatable, Notifiable;

    protected $connection = 'mysql'; // astpp DB
    protected $table      = 'accounts';
    public $timestamps    = false;

    protected $fillable = [
        'number', 'email', 'password', 'first_name', 'last_name',
        'company_name', 'balance', 'status', 'type',
    ];

    protected $hidden = ['password'];

    // Filament uses 'email' for login
    public function getAuthIdentifierName(): string { return 'email'; }
    public function getAuthIdentifier() { return $this->email; }
    public function getAuthPassword(): string { return $this->password; }
    public function getAuthPasswordName(): string { return 'password'; }
    public function getRememberToken(): string { return ''; }
    public function setRememberToken($value): void {}
    public function getRememberTokenName(): string { return ''; }

    public function canAccessPanel(Panel $panel): bool
    {
        return $panel->getId() === 'customer'
            && $this->status == 0
            && $this->deleted == 0
            && in_array($this->type, [0, 1, 3]);
    }

    public function getNameAttribute(): string
    {
        return trim($this->first_name . ' ' . $this->last_name) ?: $this->company_name ?: $this->number;
    }

    public function getFilamentName(): string
    {
        return $this->getNameAttribute();
    }

    public function getAvailableBalance(): float
    {
        return (float) $this->balance + (float) $this->credit_limit;
    }
}
