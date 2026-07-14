<?php

namespace App\Filament\Resources\FusionPBX\Databases;

use App\Filament\Resources\FusionPBX\Databases\Pages;
use App\Filament\Resources\FusionPBX\Databases\Schemas;
use App\Filament\Resources\FusionPBX\Databases\Tables;
use App\Models\FusionPBX\Databas;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class DatabasResource extends Resource
{
    protected static ?string $slug = 'databas';
    protected static \UnitEnum|string|null $navigationGroup = 'Advanced';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-circle-stack';
    protected static ?int $navigationSort = 11;
protected static ?string $model = Databas::class;
    protected static ?string $modelLabel = 'Databas';

    protected static ?string $pluralModelLabel = 'Databases';

    protected static ?string $recordTitleAttribute = 'database_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\DatabasForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\DatabasesTable::configure($table);
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
            'index' => Pages\ListDatabases::route('/'),
            'create' => Pages\CreateDatabas::route('/create'),
            'edit' => Pages\EditDatabas::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'System';
    }


    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

}
