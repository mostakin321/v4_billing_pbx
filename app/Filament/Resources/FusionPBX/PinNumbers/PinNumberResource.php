<?php

namespace App\Filament\Resources\FusionPBX\PinNumbers;

use App\Filament\Resources\FusionPBX\PinNumbers\Pages;
use App\Filament\Resources\FusionPBX\PinNumbers\Schemas;
use App\Filament\Resources\FusionPBX\PinNumbers\Tables;
use App\Models\FusionPBX\PinNumber;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class PinNumberResource extends Resource
{
    protected static ?string $slug = 'pin-number';
    protected static \UnitEnum|string|null $navigationGroup = 'Applications';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-key';
    protected static ?int $navigationSort = 9;
protected static ?string $model = PinNumber::class;
    protected static ?string $modelLabel = 'Pin Number';

    protected static ?string $pluralModelLabel = 'Pin Numbers';

    protected static ?string $recordTitleAttribute = 'description';

    public static function form(Schema $form): Schema
    {
        return Schemas\PinNumberForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\PinNumbersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPinNumbers::route('/'),
            'create' => Pages\CreatePinNumber::route('/create'),
            'edit' => Pages\EditPinNumber::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Accounts';
    }

}
