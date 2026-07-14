<?php

namespace App\Filament\Resources\FusionPBX\PhraseDetails;

use App\Filament\Resources\FusionPBX\PhraseDetails\Pages;
use App\Filament\Resources\FusionPBX\PhraseDetails\Schemas;
use App\Filament\Resources\FusionPBX\PhraseDetails\Tables;
use App\Models\FusionPBX\PhraseDetail;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class PhraseDetailResource extends Resource
{
    protected static ?string $slug = 'phrase-detail';
    protected static \UnitEnum|string|null $navigationGroup = 'Phrases';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-left';
    protected static ?int $navigationSort = 2;
protected static ?string $model = PhraseDetail::class;
    protected static ?string $modelLabel = 'Phrase Detail';

    protected static ?string $pluralModelLabel = 'Phrase Details';

    protected static ?string $recordTitleAttribute = 'phrase_detail_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\PhraseDetailForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\PhraseDetailsTable::configure($table);
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
            'index' => Pages\ListPhraseDetails::route('/'),
            'create' => Pages\CreatePhraseDetail::route('/create'),
            'edit' => Pages\EditPhraseDetail::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
