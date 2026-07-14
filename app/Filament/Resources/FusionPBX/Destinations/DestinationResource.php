<?php
namespace App\Filament\Resources\FusionPBX\Destinations;
use App\Filament\Resources\FusionPBX\Destinations\Pages;
use App\Filament\Resources\FusionPBX\Destinations\Schemas;
use App\Filament\Resources\FusionPBX\Destinations\Tables;
use App\Models\FusionPBX\Destination;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class DestinationResource extends Resource
{
    protected static ?string $slug = 'destination';
    protected static \UnitEnum|string|null $navigationGroup = 'Dialplan';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-map-pin';
    protected static ?int $navigationSort = 1;
protected static ?string $model                = Destination::class;
    protected static ?string $navigationLabel      = 'Destinations';
    protected static ?string $modelLabel           = 'Destination';
    protected static ?string $pluralModelLabel     = 'Destinations';
protected static ?string $recordTitleAttribute = 'destination_number';

    public static function form(Schema $form): Schema
    {
        return Schemas\DestinationForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\DestinationsTable::configure($table);
    }

    public static function getRelations(): array { return []; }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListDestinations::route('/'),
            'create' => Pages\CreateDestination::route('/create'),
            'edit'   => Pages\EditDestination::route('/{record}/edit'),
        ];
    }
}
