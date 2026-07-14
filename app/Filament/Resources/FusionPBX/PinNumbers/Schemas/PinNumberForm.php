<?php
namespace App\Filament\Resources\FusionPBX\PinNumbers\Schemas;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
class PinNumberForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([
            Section::make('Pin Number')->columns(2)->schema([
                TextInput::make('pin_number')->label('Pin Number')->required()
                    ->placeholder('e.g. 1234'),
                TextInput::make('accountcode')->label('Account Code')
                    ->placeholder('e.g. billing-001'),
                Select::make('enabled')->label('Enabled')
                    ->options(['true'=>'True','false'=>'False'])
                    ->default('true')->native(false),
                Textarea::make('description')
                    ->label('Description')->rows(2)->columnSpanFull(),
            ]),
        ]);
    }
}
