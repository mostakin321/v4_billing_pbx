<?php
namespace App\Filament\Resources\Astpp\IpMapResource\Pages;
use App\Filament\Resources\Astpp\IpMapResource\IpMapResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
class ListIpMaps extends ListRecords {
    protected static string $resource = IpMapResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}
