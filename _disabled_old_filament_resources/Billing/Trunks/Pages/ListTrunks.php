<?php
namespace App\Filament\Resources\Billing\Trunks\Pages;
use App\Filament\Resources\Billing\Trunks\TrunkResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
class ListTrunks extends ListRecords {
    protected static string $resource = TrunkResource::class;
    protected function getHeaderActions(): array {
        return [CreateAction::make()->label('New Trunk')];
    }
}
