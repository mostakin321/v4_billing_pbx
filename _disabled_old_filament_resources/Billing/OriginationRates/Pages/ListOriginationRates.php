<?php
namespace App\Filament\Resources\Billing\OriginationRates\Pages;
use App\Filament\Resources\Billing\OriginationRates\OriginationRateResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
class ListOriginationRates extends ListRecords {
    protected static string $resource = OriginationRateResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}
