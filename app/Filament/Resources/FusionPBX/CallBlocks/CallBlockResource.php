<?php

namespace App\Filament\Resources\FusionPBX\CallBlocks;

use App\Filament\Resources\FusionPBX\CallBlocks\Pages;
use App\Filament\Resources\FusionPBX\CallBlocks\Schemas;
use App\Filament\Resources\FusionPBX\CallBlocks\Tables;
use App\Models\FusionPBX\CallBlock;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class CallBlockResource extends Resource
{
    protected static ?string $slug = 'call-block';
    protected static \UnitEnum|string|null $navigationGroup = 'Dialplan';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-no-symbol';
    protected static ?int $navigationSort = 8;
protected static ?string $model = CallBlock::class;
    protected static ?string $modelLabel = 'Call Block';

    protected static ?string $pluralModelLabel = 'Call Blocks';

    protected static ?string $recordTitleAttribute = 'call_block_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\CallBlockForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\CallBlocksTable::configure($table);
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
            'index' => Pages\ListCallBlocks::route('/'),
            'create' => Pages\CreateCallBlock::route('/create'),
            'edit' => Pages\EditCallBlock::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
