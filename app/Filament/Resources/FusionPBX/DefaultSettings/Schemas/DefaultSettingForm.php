<?php
namespace App\Filament\Resources\FusionPBX\DefaultSettings\Schemas;

use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class DefaultSettingForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([
            Section::make('Default Setting')->columns(2)->schema([
                TextInput::make('default_setting_category')
                    ->label('Category')->required()->placeholder('e.g. voicemail'),
                TextInput::make('default_setting_subcategory')
                    ->label('Subcategory')->placeholder('e.g. enabled'),
                TextInput::make('default_setting_name')
                    ->label('Name')->required()->placeholder('e.g. boolean'),
                TextInput::make('default_setting_value')
                    ->label('Value')->placeholder('e.g. true'),
                TextInput::make('default_setting_order')
                    ->label('Order')->numeric()->default(0),
                Select::make('default_setting_enabled')
                    ->label('Enabled')
                    ->options(['true'=>'True','false'=>'False'])
                    ->default('true')->native(false),
                Textarea::make('default_setting_description')
                    ->label('Description')->rows(2)->columnSpanFull(),
            ]),
        ]);
    }
}
