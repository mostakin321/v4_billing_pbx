<?php
namespace App\Filament\Resources\FusionPBX\InboundRoutes\Pages;
use App\Filament\Resources\FusionPBX\InboundRoutes\InboundRouteResource;
use Filament\Resources\Pages\CreateRecord;
class CreateInboundRoute extends CreateRecord {
    protected static string $resource = InboundRouteResource::class;
}
