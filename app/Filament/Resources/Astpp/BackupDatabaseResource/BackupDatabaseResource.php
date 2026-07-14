<?php

namespace App\Filament\Resources\Astpp\BackupDatabaseResource;

use App\Filament\Resources\Astpp\BackupDatabaseResource\Pages;
use App\Filament\Resources\Astpp\BackupDatabaseResource\Schemas\BackupDatabaseForm;
use App\Filament\Resources\Astpp\BackupDatabaseResource\Tables\BackupDatabaseTable;
use App\Models\Astpp\BackupDatabase;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class BackupDatabaseResource extends Resource
{
    protected static ?string $model = BackupDatabase::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP System'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-document-text'; }
    public static function getNavigationLabel(): string { return 'Backup Database'; }
    public static function getModelLabel(): string { return 'Backup Database'; }
    public static function getPluralModelLabel(): string { return 'Backup Database'; }
    public static function getNavigationSort(): ?int { return 10; }

    public static function form(Schema $schema): Schema
    {
        return BackupDatabaseForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BackupDatabaseTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $model = $query->getModel();
        $columns = $model->getConnection()->getSchemaBuilder()->getColumnListing($model->getTable());

        if (in_array('deleted', $columns, true)) {
            $query->where('deleted', 0);
        }

        return $query;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBackupDatabaseRecords::route('/'),
            'create' => Pages\CreateBackupDatabase::route('/create'),
            'edit' => Pages\EditBackupDatabase::route('/{record}/edit'),
        ];
    }
}
