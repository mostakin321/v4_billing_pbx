<?php

namespace App\Filament\Resources\FusionPBX\Softwares;

use App\Filament\Resources\FusionPBX\Softwares\Pages;
use App\Filament\Resources\FusionPBX\Softwares\Schemas;
use App\Filament\Resources\FusionPBX\Softwares\Tables;
use App\Models\FusionPBX\Software;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class SoftwareResource extends Resource
{
    protected static ?string $slug = 'software';
    protected static \UnitEnum|string|null $navigationGroup = 'Advanced';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cpu-chip';
    protected static ?int $navigationSort = 10;
protected static ?string $model = Software::class;
    protected static ?string $modelLabel = 'Software';

    protected static ?string $pluralModelLabel = 'Softwares';

    protected static ?string $recordTitleAttribute = 'software_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\SoftwareForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\SoftwaresTable::configure($table);
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
            'index' => Pages\ListSoftwares::route('/'),
            'create' => Pages\CreateSoftware::route('/create'),
            'edit' => Pages\EditSoftware::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'System';
    }

}
