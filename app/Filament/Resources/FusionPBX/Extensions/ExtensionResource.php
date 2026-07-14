<?php

namespace App\Filament\Resources\FusionPBX\Extensions;

use App\Filament\Resources\FusionPBX\Extensions\Pages;
use App\Filament\Resources\FusionPBX\Extensions\Schemas;
use App\Filament\Resources\FusionPBX\Extensions\Tables;
use App\Models\FusionPBX\Extension;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ExtensionResource extends Resource
{
    protected static ?string $slug = 'extension';
    protected static \UnitEnum|string|null $navigationGroup = 'Accounts';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-phone';
    protected static ?int $navigationSort = 1;
protected static ?string $model = Extension::class;
    protected static ?string $modelLabel = 'Extension';

    protected static ?string $pluralModelLabel = 'Extensions';

    protected static ?string $recordTitleAttribute = 'description';

    public static function form(Schema $form): Schema
    {
        return Schemas\ExtensionForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\ExtensionsTable::configure($table);
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
            'index' => Pages\ListExtensions::route('/'),
            'create' => Pages\CreateExtension::route('/create'),
            'edit' => Pages\EditExtension::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Accounts';
    }

}
