<?php
namespace App\Filament\Resources\FusionPBX\OutboundRoutes\Pages;
use App\Filament\Resources\FusionPBX\OutboundRoutes\OutboundRouteResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
class ListOutboundRoutes extends ListRecords {
    protected static string $resource = OutboundRouteResource::class;
    protected function getHeaderActions(): array {
        return [
            Action::make('create')
                ->label('New Outbound Route')
                ->icon('heroicon-o-plus')
                ->url(OutboundRouteResource::getUrl('create')),
        ];
    }
}
