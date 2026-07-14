<?php
namespace App\Filament\Customer\Widgets;

use Filament\Widgets\Widget;

class CustomerBalanceWidget extends Widget
{
    protected string $view = 'filament.customer.widgets.balance-widget';
    protected static ?int $sort = 1;
    protected int|string|array $columnSpan = 1;

    public function getViewData(): array
    {
        $customer = auth('customer')->user();
        return [
            'balance'        => (float) $customer->balance,
            'credit_limit'   => (float) $customer->credit_limit,
            'available'      => (float) $customer->balance + (float) $customer->credit_limit,
            'number'         => $customer->number,
            'name'           => trim($customer->first_name . ' ' . $customer->last_name) ?: $customer->company_name,
            'email'          => $customer->email,
            'status'         => $customer->status == 0 ? 'Active' : 'Inactive',
        ];
    }
}
