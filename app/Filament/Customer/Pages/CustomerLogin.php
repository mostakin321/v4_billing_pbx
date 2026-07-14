<?php
namespace App\Filament\Customer\Pages;

use App\Models\Customer;
use App\Services\CustomerAuthService;
use Filament\Auth\Pages\Login;
use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Illuminate\Validation\ValidationException;

class CustomerLogin extends Login
{
    public function authenticate(): ?LoginResponse
    {
        $data = $this->form->getState();
        $login    = $data['email'];
        $password = $data['password'];

        $authService = app(CustomerAuthService::class);
        $account     = $authService->attempt($login, $password);

        if (!$account) {
            throw ValidationException::withMessages([
                'data.email' => __('filament-panels::pages/auth/login.messages.failed'),
            ]);
        }

        $customer = Customer::find($account->id);
        auth('customer')->login($customer);
        session()->regenerate();

        return app(LoginResponse::class);
    }
}
