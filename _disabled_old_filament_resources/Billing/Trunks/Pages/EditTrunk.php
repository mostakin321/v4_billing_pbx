<?php
namespace App\Filament\Resources\Billing\Trunks\Pages;
use App\Filament\Resources\Billing\Trunks\TrunkResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditTrunk extends EditRecord {
    protected static string $resource = TrunkResource::class;
    protected function getHeaderActions(): array {
        return [DeleteAction::make()];
    }
}
