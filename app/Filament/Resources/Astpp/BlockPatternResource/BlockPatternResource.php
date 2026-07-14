<?php

namespace App\Filament\Resources\Astpp\BlockPatternResource;

use App\Filament\Resources\Astpp\BlockPatternResource\Pages;
use App\Filament\Resources\Astpp\BlockPatternResource\Schemas\BlockPatternForm;
use App\Filament\Resources\Astpp\BlockPatternResource\Tables\BlockPatternTable;
use App\Models\Astpp\BlockPattern;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class BlockPatternResource extends Resource
{
    protected static ?string $model = BlockPattern::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP Accounts'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-circle-stack'; }
    public static function getNavigationLabel(): string { return 'Block Patterns'; }
    public static function getModelLabel(): string { return 'Block Patterns'; }
    public static function getPluralModelLabel(): string { return 'Block Patterns'; }
    public static function getNavigationSort(): ?int { return 11; }

    public static function form(Schema $schema): Schema
    {
        return BlockPatternForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BlockPatternTable::configure($table);
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
            'index' => Pages\ListBlockPatternRecords::route('/'),
            'create' => Pages\CreateBlockPattern::route('/create'),
            'edit' => Pages\EditBlockPattern::route('/{record}/edit'),
        ];
    }
}
