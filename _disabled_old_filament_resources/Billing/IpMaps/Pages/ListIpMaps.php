<?php
namespace App\Filament\Resources\Billing\IpMaps\Pages;
use App\Filament\Resources\Billing\IpMaps\IpMapResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
class ListIpMaps extends ListRecords {
    protected static string $resource = IpMapResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}
