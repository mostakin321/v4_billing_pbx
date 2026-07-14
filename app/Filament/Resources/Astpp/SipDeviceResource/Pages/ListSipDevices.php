<?php
namespace App\Filament\Resources\Astpp\SipDeviceResource\Pages;
use App\Filament\Resources\Astpp\SipDeviceResource\SipDeviceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
class ListSipDevices extends ListRecords
{
    protected static string $resource = SipDeviceResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}
