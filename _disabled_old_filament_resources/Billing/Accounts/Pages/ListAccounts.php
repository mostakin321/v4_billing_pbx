<?php
namespace App\Filament\Resources\Billing\Accounts\Pages;
use App\Filament\Resources\Billing\Accounts\AccountResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
class ListAccounts extends ListRecords
{
    protected static string $resource = AccountResource::class;
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Create Account'),
        ];
    }
}
