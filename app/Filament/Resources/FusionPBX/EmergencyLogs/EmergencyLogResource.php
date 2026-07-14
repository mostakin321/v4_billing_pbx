<?php

namespace App\Filament\Resources\FusionPBX\EmergencyLogs;

use App\Filament\Resources\FusionPBX\EmergencyLogs\Pages;
use App\Filament\Resources\FusionPBX\EmergencyLogs\Schemas;
use App\Filament\Resources\FusionPBX\EmergencyLogs\Tables;
use App\Models\FusionPBX\EmergencyLog;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class EmergencyLogResource extends Resource
{
    protected static ?string $slug = 'emergency-log';
    protected static \UnitEnum|string|null $navigationGroup = 'Reports';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-exclamation-triangle';
    protected static ?int $navigationSort = 6;
protected static ?string $model = EmergencyLog::class;
    protected static ?string $modelLabel = 'Emergency Log';

    protected static ?string $pluralModelLabel = 'Emergency Logs';

    protected static ?string $recordTitleAttribute = 'extension';

    public static function form(Schema $form): Schema
    {
        return Schemas\EmergencyLogForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\EmergencyLogsTable::configure($table);
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
            'index' => Pages\ListEmergencyLogs::route('/'),
            'create' => Pages\CreateEmergencyLog::route('/create'),
            'edit' => Pages\EditEmergencyLog::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Reports';
    }

}
