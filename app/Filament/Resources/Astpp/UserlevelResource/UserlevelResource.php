<?php

namespace App\Filament\Resources\Astpp\UserlevelResource;

use App\Filament\Resources\Astpp\UserlevelResource\Pages;
use App\Filament\Resources\Astpp\UserlevelResource\Schemas\UserlevelForm;
use App\Filament\Resources\Astpp\UserlevelResource\Tables\UserlevelTable;
use App\Models\Astpp\Userlevel;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class UserlevelResource extends Resource
{
    protected static ?string $model = Userlevel::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP System'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-phone'; }
    public static function getNavigationLabel(): string { return 'Userlevels'; }
    public static function getModelLabel(): string { return 'Userlevels'; }
    public static function getPluralModelLabel(): string { return 'Userlevels'; }
    public static function getNavigationSort(): ?int { return 68; }

    public static function form(Schema $schema): Schema
    {
        return UserlevelForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UserlevelTable::configure($table);
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
            'index' => Pages\ListUserlevelRecords::route('/'),
            'create' => Pages\CreateUserlevel::route('/create'),
            'edit' => Pages\EditUserlevel::route('/{record}/edit'),
        ];
    }
}
