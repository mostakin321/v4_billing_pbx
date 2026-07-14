<?php
namespace App\Filament\Resources\Billing\SipDevices\Pages;
use App\Filament\Resources\Billing\SipDevices\SipDeviceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
class ListSipDevices extends ListRecords
{
    protected static string $resource = SipDeviceResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}
