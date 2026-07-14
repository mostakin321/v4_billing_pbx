<?php

namespace App\Filament\Resources\FusionPBX\Countries;

use App\Filament\Resources\FusionPBX\Countries\Pages;
use App\Filament\Resources\FusionPBX\Countries\Schemas;
use App\Filament\Resources\FusionPBX\Countries\Tables;
use App\Models\FusionPBX\Country;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class CountryResource extends Resource
{
    protected static ?string $slug = 'country';
    protected static \UnitEnum|string|null $navigationGroup = 'Advanced';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-flag';
    protected static ?int $navigationSort = 5;
protected static ?string $model = Country::class;
    protected static ?string $modelLabel = 'Country';

    protected static ?string $pluralModelLabel = 'Countries';

    protected static ?string $recordTitleAttribute = 'country_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\CountryForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\CountriesTable::configure($table);
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
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountry::route('/create'),
            'edit' => Pages\EditCountry::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Contacts';
    }

}
