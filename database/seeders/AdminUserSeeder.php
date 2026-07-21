<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['super_admin', 'admin', 'reseller', 'customer'] as $roleName) {
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }

        $email = env('ADMIN_SEED_EMAIL', 'admin@kazitel.local');
        $password = env('ADMIN_SEED_PASSWORD', 'Admin1234');

        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => 'admin',
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ]
        );

        if (! $user->hasRole('admin')) {
            $user->assignRole('admin');
        }

        $this->command->info("Admin user ready: {$email}");
    }
}
