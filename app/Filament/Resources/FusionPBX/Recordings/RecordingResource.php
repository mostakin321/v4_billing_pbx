<?php

namespace App\Filament\Resources\FusionPBX\Recordings;

use App\Filament\Resources\FusionPBX\Recordings\Pages;
use App\Filament\Resources\FusionPBX\Recordings\Schemas;
use App\Filament\Resources\FusionPBX\Recordings\Tables;
use App\Models\FusionPBX\Recording;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class RecordingResource extends Resource
{
    protected static ?string $slug = 'recording';
    protected static \UnitEnum|string|null $navigationGroup = 'Applications';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-microphone';
    protected static ?int $navigationSort = 10;
protected static ?string $model = Recording::class;
    protected static ?string $modelLabel = 'Recording';

    protected static ?string $pluralModelLabel = 'Recordings';

    protected static ?string $recordTitleAttribute = 'recording_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\RecordingForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\RecordingsTable::configure($table);
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
            'index' => Pages\ListRecordings::route('/'),
            'create' => Pages\CreateRecording::route('/create'),
            'edit' => Pages\EditRecording::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
