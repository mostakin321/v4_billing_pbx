<?php

namespace App\Filament\Resources\Astpp\FreeswichServerResource;

use App\Filament\Resources\Astpp\FreeswichServerResource\Pages;
use App\Filament\Resources\Astpp\FreeswichServerResource\Schemas\FreeswichServerForm;
use App\Filament\Resources\Astpp\FreeswichServerResource\Tables\FreeswichServerTable;
use App\Models\Astpp\FreeswichServer;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class FreeswichServerResource extends Resource
{
    protected static ?string $model = FreeswichServer::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP PBX'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-currency-dollar'; }
    public static function getNavigationLabel(): string { return 'Freeswich Servers'; }
    public static function getModelLabel(): string { return 'Freeswich Servers'; }
    public static function getPluralModelLabel(): string { return 'Freeswich Servers'; }
    public static function getNavigationSort(): ?int { return 27; }

    public static function form(Schema $schema): Schema
    {
        return FreeswichServerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FreeswichServerTable::configure($table);
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
            'index' => Pages\ListFreeswichServerRecords::route('/'),
            'create' => Pages\CreateFreeswichServer::route('/create'),
            'edit' => Pages\EditFreeswichServer::route('/{record}/edit'),
        ];
    }
}
