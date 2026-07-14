<?php
namespace App\Filament\Resources\Astpp\SipDeviceResource;
use App\Models\Astpp\SipDevice;
use App\Filament\Resources\Astpp\SipDeviceResource\Pages;
use App\Filament\Resources\Astpp\SipDeviceResource\Schemas\SipDeviceForm;
use App\Filament\Resources\Astpp\SipDeviceResource\Tables\SipDevicesTable;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
class SipDeviceResource extends Resource
{
    protected static ?string $model = SipDevice::class;
    public static function getNavigationGroup(): ?string { return 'Billing'; }
    public static function getNavigationIcon(): string|\Illuminate\Contracts\Support\Htmlable|null { return 'heroicon-o-device-phone-mobile'; }
    public static function getNavigationLabel(): string { return 'SIP Devices'; }
    public static function getNavigationSort(): ?int { return 3; }
    public static function getModelLabel(): string { return 'SIP Device'; }
    public static function getPluralModelLabel(): string { return 'SIP Devices'; }
    public static function form(Schema $form): Schema { return SipDeviceForm::configure($form); }
    public static function table(Table $table): Table { return SipDevicesTable::configure($table); }
    public static function getPages(): array {
        return [
            'index'  => Pages\ListSipDevices::route('/'),
            'create' => Pages\CreateSipDevice::route('/create'),
            'edit'   => Pages\EditSipDevice::route('/{record}/edit'),
        ];
    }
}
