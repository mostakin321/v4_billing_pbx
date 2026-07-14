<?php

namespace App\Filament\Resources\FusionPBX\FaxLogs;

use App\Filament\Resources\FusionPBX\FaxLogs\Pages;
use App\Filament\Resources\FusionPBX\FaxLogs\Schemas;
use App\Filament\Resources\FusionPBX\FaxLogs\Tables;
use App\Models\FusionPBX\FaxLog;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class FaxLogResource extends Resource
{
    protected static ?string $slug = 'fax-log';
    protected static \UnitEnum|string|null $navigationGroup = 'Fax';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-clipboard-document';
    protected static ?int $navigationSort = 5;
protected static ?string $model = FaxLog::class;
    protected static ?string $modelLabel = 'Fax Log';

    protected static ?string $pluralModelLabel = 'Fax Logs';

    protected static ?string $recordTitleAttribute = 'fax_log_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\FaxLogForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\FaxLogsTable::configure($table);
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
            'index' => Pages\ListFaxLogs::route('/'),
            'create' => Pages\CreateFaxLog::route('/create'),
            'edit' => Pages\EditFaxLog::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Reports';
    }

}
