<?php

namespace App\Filament\Resources\FusionPBX\EmailTemplates;

use App\Filament\Resources\FusionPBX\EmailTemplates\Pages;
use App\Filament\Resources\FusionPBX\EmailTemplates\Schemas;
use App\Filament\Resources\FusionPBX\EmailTemplates\Tables;
use App\Models\FusionPBX\EmailTemplate;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class EmailTemplateResource extends Resource
{
    protected static ?string $slug = 'email-template';
    protected static \UnitEnum|string|null $navigationGroup = 'Email';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-envelope';
    protected static ?int $navigationSort = 3;
protected static ?string $model = EmailTemplate::class;
    protected static ?string $modelLabel = 'Email Template';

    protected static ?string $pluralModelLabel = 'Email Templates';

    protected static ?string $recordTitleAttribute = 'email_template_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\EmailTemplateForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\EmailTemplatesTable::configure($table);
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
            'index' => Pages\ListEmailTemplates::route('/'),
            'create' => Pages\CreateEmailTemplate::route('/create'),
            'edit' => Pages\EditEmailTemplate::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Messaging';
    }

}
