<?php

namespace App\Filament\Resources\FusionPBX\NumberTranslationDetails;

use App\Filament\Resources\FusionPBX\NumberTranslationDetails\Pages;
use App\Filament\Resources\FusionPBX\NumberTranslationDetails\Schemas;
use App\Filament\Resources\FusionPBX\NumberTranslationDetails\Tables;
use App\Models\FusionPBX\NumberTranslationDetail;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class NumberTranslationDetailResource extends Resource
{
    protected static ?string $slug = 'number-translation-detail';
    protected static \UnitEnum|string|null $navigationGroup = 'Dialplan';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-hashtag';
    protected static ?int $navigationSort = 7;
protected static ?string $model = NumberTranslationDetail::class;
    protected static ?string $modelLabel = 'Number Translation Detail';

    protected static ?string $pluralModelLabel = 'Number Translation Details';

    protected static ?string $recordTitleAttribute = 'number_translation_detail_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\NumberTranslationDetailForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\NumberTranslationDetailsTable::configure($table);
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
            'index' => Pages\ListNumberTranslationDetails::route('/'),
            'create' => Pages\CreateNumberTranslationDetail::route('/create'),
            'edit' => Pages\EditNumberTranslationDetail::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Dialplan';
    }

}
