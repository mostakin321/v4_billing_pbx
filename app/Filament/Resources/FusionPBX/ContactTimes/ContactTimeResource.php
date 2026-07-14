<?php

namespace App\Filament\Resources\FusionPBX\ContactTimes;

use App\Filament\Resources\FusionPBX\ContactTimes\Pages;
use App\Filament\Resources\FusionPBX\ContactTimes\Schemas;
use App\Filament\Resources\FusionPBX\ContactTimes\Tables;
use App\Models\FusionPBX\ContactTime;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ContactTimeResource extends Resource
{
    protected static ?string $slug = 'contact-time';
    protected static \UnitEnum|string|null $navigationGroup = 'Contacts';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-clock';
    protected static ?int $navigationSort = 11;
protected static ?string $model = ContactTime::class;
    protected static ?string $modelLabel = 'Contact Time';

    protected static ?string $pluralModelLabel = 'Contact Times';

    protected static ?string $recordTitleAttribute = 'contact_time_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\ContactTimeForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\ContactTimesTable::configure($table);
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
            'index' => Pages\ListContactTimes::route('/'),
            'create' => Pages\CreateContactTime::route('/create'),
            'edit' => Pages\EditContactTime::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Contacts';
    }

}
