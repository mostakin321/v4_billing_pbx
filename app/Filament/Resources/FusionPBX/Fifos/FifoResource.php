<?php

namespace App\Filament\Resources\FusionPBX\Fifos;

use App\Filament\Resources\FusionPBX\Fifos\Pages;
use App\Filament\Resources\FusionPBX\Fifos\Schemas;
use App\Filament\Resources\FusionPBX\Fifos\Tables;
use App\Models\FusionPBX\Fifo;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class FifoResource extends Resource
{
    protected static ?string $slug = 'fifo';
    protected static \UnitEnum|string|null $navigationGroup = 'Applications';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-inbox';
    protected static ?int $navigationSort = 15;
protected static ?string $model = Fifo::class;
    protected static ?string $modelLabel = 'Fifo';

    protected static ?string $pluralModelLabel = 'Fifos';

    protected static ?string $recordTitleAttribute = 'fifo_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\FifoForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\FifosTable::configure($table);
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
            'index' => Pages\ListFifos::route('/'),
            'create' => Pages\CreateFifo::route('/create'),
            'edit' => Pages\EditFifo::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Call Center';
    }

}
