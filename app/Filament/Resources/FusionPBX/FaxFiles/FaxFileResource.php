<?php

namespace App\Filament\Resources\FusionPBX\FaxFiles;

use App\Filament\Resources\FusionPBX\FaxFiles\Pages;
use App\Filament\Resources\FusionPBX\FaxFiles\Schemas;
use App\Filament\Resources\FusionPBX\FaxFiles\Tables;
use App\Models\FusionPBX\FaxFile;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class FaxFileResource extends Resource
{
    protected static ?string $slug = 'fax-file';
    protected static \UnitEnum|string|null $navigationGroup = 'Fax';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-paper-clip';
    protected static ?int $navigationSort = 4;
protected static ?string $model = FaxFile::class;
    protected static ?string $modelLabel = 'Fax File';

    protected static ?string $pluralModelLabel = 'Fax Files';

    protected static ?string $recordTitleAttribute = 'fax_file_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\FaxFileForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\FaxFilesTable::configure($table);
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
            'index' => Pages\ListFaxFiles::route('/'),
            'create' => Pages\CreateFaxFile::route('/create'),
            'edit' => Pages\EditFaxFile::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
