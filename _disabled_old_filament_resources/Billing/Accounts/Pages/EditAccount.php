<?php
namespace App\Filament\Resources\Billing\Accounts\Pages;
use App\Filament\Resources\Billing\Accounts\AccountResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditAccount extends EditRecord
{
    protected static string $resource = AccountResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (empty($data['reseller_id'])) $data['reseller_id'] = 0;
        return $data;
    }
}
