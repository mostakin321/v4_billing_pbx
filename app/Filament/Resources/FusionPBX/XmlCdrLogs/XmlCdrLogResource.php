<?php

namespace App\Filament\Resources\FusionPBX\XmlCdrLogs;

use App\Filament\Resources\FusionPBX\XmlCdrLogs\Pages;
use App\Filament\Resources\FusionPBX\XmlCdrLogs\Schemas;
use App\Filament\Resources\FusionPBX\XmlCdrLogs\Tables;
use App\Models\FusionPBX\XmlCdrLog;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class XmlCdrLogResource extends Resource
{
    protected static ?string $slug = 'xml-cdr-log';
    protected static \UnitEnum|string|null $navigationGroup = 'Reports';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-magnifying-glass';
    protected static ?int $navigationSort = 5;
protected static ?string $model = XmlCdrLog::class;
    protected static ?string $modelLabel = 'Xml Cdr Log';

    protected static ?string $pluralModelLabel = 'Xml Cdr Logs';

    protected static ?string $recordTitleAttribute = 'xml_cdr_log_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\XmlCdrLogForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\XmlCdrLogsTable::configure($table);
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
            'index' => Pages\ListXmlCdrLogs::route('/'),
            'create' => Pages\CreateXmlCdrLog::route('/create'),
            'edit' => Pages\EditXmlCdrLog::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Reports';
    }

}
