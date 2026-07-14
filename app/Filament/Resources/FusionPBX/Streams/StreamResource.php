<?php

namespace App\Filament\Resources\FusionPBX\Streams;

use App\Filament\Resources\FusionPBX\Streams\Pages;
use App\Filament\Resources\FusionPBX\Streams\Schemas;
use App\Filament\Resources\FusionPBX\Streams\Tables;
use App\Models\FusionPBX\Stream;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class StreamResource extends Resource
{
    protected static ?string $slug = 'stream';
    protected static \UnitEnum|string|null $navigationGroup = 'SIP & Gateways';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-signal';
    protected static ?int $navigationSort = 7;
protected static ?string $model = Stream::class;
    protected static ?string $modelLabel = 'Stream';

    protected static ?string $pluralModelLabel = 'Streams';

    protected static ?string $recordTitleAttribute = 'stream_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\StreamForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\StreamsTable::configure($table);
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
            'index' => Pages\ListStreams::route('/'),
            'create' => Pages\CreateStream::route('/create'),
            'edit' => Pages\EditStream::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'SIP & Gateways';
    }

}
