<?php

namespace App\Filament\Resources\FusionPBX\Phrases;

use App\Filament\Resources\FusionPBX\Phrases\Pages;
use App\Filament\Resources\FusionPBX\Phrases\Schemas;
use App\Filament\Resources\FusionPBX\Phrases\Tables;
use App\Models\FusionPBX\Phras;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class PhrasResource extends Resource
{
    protected static ?string $slug = 'phras';
    protected static \UnitEnum|string|null $navigationGroup = 'Phrases';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';
    protected static ?int $navigationSort = 1;
protected static ?string $model = Phras::class;
    protected static ?string $modelLabel = 'Phras';

    protected static ?string $pluralModelLabel = 'Phrases';

    protected static ?string $recordTitleAttribute = 'phrase_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\PhrasForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\PhrasesTable::configure($table);
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
            'index' => Pages\ListPhrases::route('/'),
            'create' => Pages\CreatePhras::route('/create'),
            'edit' => Pages\EditPhras::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
