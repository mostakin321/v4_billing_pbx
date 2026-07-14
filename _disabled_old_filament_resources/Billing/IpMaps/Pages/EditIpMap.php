<?php
namespace App\Filament\Resources\Billing\IpMaps\Pages;
use App\Filament\Resources\Billing\IpMaps\IpMapResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditIpMap extends EditRecord {
    protected static string $resource = IpMapResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
