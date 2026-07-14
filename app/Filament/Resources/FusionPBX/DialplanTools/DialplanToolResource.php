<?php

namespace App\Filament\Resources\FusionPBX\DialplanTools;

use App\Filament\Resources\FusionPBX\DialplanTools\Pages;
use App\Filament\Resources\FusionPBX\DialplanTools\Schemas;
use App\Filament\Resources\FusionPBX\DialplanTools\Tables;
use App\Models\FusionPBX\DialplanTool;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class DialplanToolResource extends Resource
{
    protected static ?string $slug = 'dialplan-tool';
    protected static \UnitEnum|string|null $navigationGroup = 'Dialplan';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-wrench';
    protected static ?int $navigationSort = 9;
protected static ?string $model = DialplanTool::class;
    protected static ?string $modelLabel = 'Dialplan Tool';

    protected static ?string $pluralModelLabel = 'Dialplan Tools';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $form): Schema
    {
        return Schemas\DialplanToolForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\DialplanToolsTable::configure($table);
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
            'index' => Pages\ListDialplanTools::route('/'),
            'create' => Pages\CreateDialplanTool::route('/create'),
            'edit' => Pages\EditDialplanTool::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Dialplan';
    }


    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

}
