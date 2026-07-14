<?php
namespace App\Filament\Resources\Astpp\OutboundRouteResource\Pages;
use App\Filament\Resources\Astpp\OutboundRouteResource\OutboundRouteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOutboundRoutes extends ListRecords
{
    protected static string $resource = OutboundRouteResource::class;

    public function getTitle(): string { return 'Termination Rates'; }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('New Termination Rate'),
        ];
    }
}
