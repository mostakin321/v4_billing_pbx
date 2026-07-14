<?php

namespace App\Filament\Resources\FusionPBX\VoicemailOptions;

use App\Filament\Resources\FusionPBX\VoicemailOptions\Pages;
use App\Filament\Resources\FusionPBX\VoicemailOptions\Schemas;
use App\Filament\Resources\FusionPBX\VoicemailOptions\Tables;
use App\Models\FusionPBX\VoicemailOption;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class VoicemailOptionResource extends Resource
{
    protected static ?string $slug = 'voicemail-option';
    protected static \UnitEnum|string|null $navigationGroup = 'Voicemail';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog';
    protected static ?int $navigationSort = 4;
protected static ?string $model = VoicemailOption::class;
    protected static ?string $modelLabel = 'Voicemail Option';

    protected static ?string $pluralModelLabel = 'Voicemail Options';

    protected static ?string $recordTitleAttribute = 'voicemail_option_description';

    public static function form(Schema $form): Schema
    {
        return Schemas\VoicemailOptionForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\VoicemailOptionsTable::configure($table);
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
            'index' => Pages\ListVoicemailOptions::route('/'),
            'create' => Pages\CreateVoicemailOption::route('/create'),
            'edit' => Pages\EditVoicemailOption::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
