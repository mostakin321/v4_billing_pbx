<?php
namespace App\Filament\Resources\Billing\Accounts\Pages;
use App\Filament\Resources\Billing\Accounts\AccountResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\CreateRecord;
class CreateAccount extends CreateRecord
{
    protected static string $resource = AccountResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['reseller_id'])) $data['reseller_id'] = 0;
        $data['creation'] = now();
        $data['deleted'] = 0;
        $data['inuse'] = 0;
        $data['dialed_modify'] = '';
        $data['charge_per_min'] = '';
        $data['std_cid_translation'] = '';
        $data['did_cid_translation'] = '';
        $data['reference'] = '';
        $data['last_bill_date'] = '0000-00-00 00:00:00';
        return $data;
    }
}
