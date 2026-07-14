<?php
namespace App\Filament\Resources\FusionPBX\DomainSettings\Schemas;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
class DomainSettingForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([
            Section::make('Domain Setting')->columns(2)->schema([
                TextInput::make('domain_setting_category')->label('Category')->required()
                    ->placeholder('e.g. voicemail'),
                TextInput::make('domain_setting_subcategory')->label('Subcategory')
                    ->placeholder('e.g. enabled'),
                TextInput::make('domain_setting_name')->label('Name')->required()
                    ->placeholder('e.g. boolean'),
                TextInput::make('domain_setting_value')->label('Value')
                    ->placeholder('e.g. true'),
                TextInput::make('domain_setting_order')->label('Order')->numeric()->default(0),
                Select::make('domain_setting_enabled')->label('Enabled')
                    ->options(['true'=>'True','false'=>'False'])
                    ->default('true')->native(false),
                Textarea::make('domain_setting_description')
                    ->label('Description')->rows(2)->columnSpanFull(),
            ]),
        ]);
    }
}
