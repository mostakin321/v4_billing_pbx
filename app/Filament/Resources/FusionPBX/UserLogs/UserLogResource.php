<?php

namespace App\Filament\Resources\FusionPBX\UserLogs;

use App\Filament\Resources\FusionPBX\UserLogs\Pages;
use App\Filament\Resources\FusionPBX\UserLogs\Schemas;
use App\Filament\Resources\FusionPBX\UserLogs\Tables;
use App\Models\FusionPBX\UserLog;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class UserLogResource extends Resource
{
    protected static ?string $slug = 'user-log';
    protected static \UnitEnum|string|null $navigationGroup = 'Accounts';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?int $navigationSort = 8;
protected static ?string $model = UserLog::class;
    protected static ?string $modelLabel = 'User Log';

    protected static ?string $pluralModelLabel = 'User Logs';

    protected static ?string $recordTitleAttribute = 'username';

    public static function form(Schema $form): Schema
    {
        return Schemas\UserLogForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\UserLogsTable::configure($table);
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
            'index' => Pages\ListUserLogs::route('/'),
            'create' => Pages\CreateUserLog::route('/create'),
            'edit' => Pages\EditUserLog::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Reports';
    }

}
