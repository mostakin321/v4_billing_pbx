<?php

namespace App\Filament\Resources\Astpp\DidCallTypeResource;

use App\Filament\Resources\Astpp\DidCallTypeResource\Pages;
use App\Filament\Resources\Astpp\DidCallTypeResource\Schemas\DidCallTypeForm;
use App\Filament\Resources\Astpp\DidCallTypeResource\Tables\DidCallTypeTable;
use App\Models\Astpp\DidCallType;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class DidCallTypeResource extends Resource
{
    protected static ?string $model = DidCallType::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP DID'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-user-group'; }
    public static function getNavigationLabel(): string { return 'Did Call Types'; }
    public static function getModelLabel(): string { return 'Did Call Types'; }
    public static function getPluralModelLabel(): string { return 'Did Call Types'; }
    public static function getNavigationSort(): ?int { return 25; }

    public static function form(Schema $schema): Schema
    {
        return DidCallTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DidCallTypeTable::configure($table);
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
            'index' => Pages\ListDidCallTypeRecords::route('/'),
            'create' => Pages\CreateDidCallType::route('/create'),
            'edit' => Pages\EditDidCallType::route('/{record}/edit'),
        ];
    }
}
