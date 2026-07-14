<?php
namespace App\Filament\Resources\Billing\Dids\Pages;
use App\Filament\Resources\Billing\Dids\DidResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditDid extends EditRecord {
    protected static string $resource = DidResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
