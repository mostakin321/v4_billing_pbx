<?php
namespace App\Services\Billing;

use Illuminate\Database\Eloquent\Builder;

class UserBillingService
{
    public function applyScope(Builder $query, $user): Builder
    {
        // Show all accounts to all admin users for now
        // Add role-based scoping after Spatie permissions is configured
        return $query;
    }
}
