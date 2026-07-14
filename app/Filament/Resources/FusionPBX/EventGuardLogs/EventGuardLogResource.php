<?php

namespace App\Filament\Resources\FusionPBX\EventGuardLogs;

use App\Filament\Resources\FusionPBX\EventGuardLogs\Pages;
use App\Filament\Resources\FusionPBX\EventGuardLogs\Schemas;
use App\Filament\Resources\FusionPBX\EventGuardLogs\Tables;
use App\Models\FusionPBX\EventGuardLog;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class EventGuardLogResource extends Resource
{
    protected static ?string $slug = 'event-guard-log';
    protected static \UnitEnum|string|null $navigationGroup = 'Reports';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-shield-exclamation';
    protected static ?int $navigationSort = 7;
protected static ?string $model = EventGuardLog::class;
    protected static ?string $modelLabel = 'Event Guard Log';

    protected static ?string $pluralModelLabel = 'Event Guard Logs';

    protected static ?string $recordTitleAttribute = 'extension';

    public static function form(Schema $form): Schema
    {
        return Schemas\EventGuardLogForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\EventGuardLogsTable::configure($table);
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
            'index' => Pages\ListEventGuardLogs::route('/'),
            'create' => Pages\CreateEventGuardLog::route('/create'),
            'edit' => Pages\EditEventGuardLog::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Reports';
    }

}
