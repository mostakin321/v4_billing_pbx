<?php
namespace App\Filament\Resources\Astpp\IpMapResource\Pages;
use App\Filament\Resources\Astpp\IpMapResource\IpMapResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditIpMap extends EditRecord {
    protected static string $resource = IpMapResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
