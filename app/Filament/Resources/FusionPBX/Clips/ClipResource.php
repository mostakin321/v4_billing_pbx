<?php

namespace App\Filament\Resources\FusionPBX\Clips;

use App\Filament\Resources\FusionPBX\Clips\Pages;
use App\Filament\Resources\FusionPBX\Clips\Schemas;
use App\Filament\Resources\FusionPBX\Clips\Tables;
use App\Models\FusionPBX\Clip;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ClipResource extends Resource
{
    protected static ?string $slug = 'clip';
    protected static \UnitEnum|string|null $navigationGroup = 'Applications';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-minus';
    protected static ?int $navigationSort = 14;
protected static ?string $model = Clip::class;
    protected static ?string $modelLabel = 'Clip';

    protected static ?string $pluralModelLabel = 'Clips';

    protected static ?string $recordTitleAttribute = 'clip_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\ClipForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\ClipsTable::configure($table);
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
            'index' => Pages\ListClips::route('/'),
            'create' => Pages\CreateClip::route('/create'),
            'edit' => Pages\EditClip::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }


    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

}
