<?php

namespace App\Filament\Resources\FusionPBX\DialplanDetails;

use App\Filament\Resources\FusionPBX\DialplanDetails\Pages;
use App\Filament\Resources\FusionPBX\DialplanDetails\Schemas;
use App\Filament\Resources\FusionPBX\DialplanDetails\Tables;
use App\Models\FusionPBX\DialplanDetail;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class DialplanDetailResource extends Resource
{
    protected static ?string $slug = 'dialplan-detail';
    protected static \UnitEnum|string|null $navigationGroup = 'Dialplan';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-bars-3';
    protected static ?int $navigationSort = 5;
protected static ?string $model = DialplanDetail::class;
    protected static ?string $modelLabel = 'Dialplan Detail';

    protected static ?string $pluralModelLabel = 'Dialplan Details';

    protected static ?string $recordTitleAttribute = 'dialplan_detail_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\DialplanDetailForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\DialplanDetailsTable::configure($table);
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
            'index' => Pages\ListDialplanDetails::route('/'),
            'create' => Pages\CreateDialplanDetail::route('/create'),
            'edit' => Pages\EditDialplanDetail::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Dialplan';
    }

}
