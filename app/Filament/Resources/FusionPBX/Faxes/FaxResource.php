<?php

namespace App\Filament\Resources\FusionPBX\Faxes;

use App\Filament\Resources\FusionPBX\Faxes\Pages;
use App\Filament\Resources\FusionPBX\Faxes\Schemas;
use App\Filament\Resources\FusionPBX\Faxes\Tables;
use App\Models\FusionPBX\Fax;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class FaxResource extends Resource
{
    protected static ?string $slug = 'fax';
    protected static \UnitEnum|string|null $navigationGroup = 'Fax';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
    protected static ?int $navigationSort = 1;
protected static ?string $model = Fax::class;
    protected static ?string $modelLabel = 'Fax';

    protected static ?string $pluralModelLabel = 'Faxes';

    protected static ?string $recordTitleAttribute = 'fax_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\FaxForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\FaxesTable::configure($table);
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
            'index' => Pages\ListFaxes::route('/'),
            'create' => Pages\CreateFax::route('/create'),
            'edit' => Pages\EditFax::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
