<?php

namespace App\Filament\Resources\FusionPBX\ConferenceProfileParams\Schemas;

use Carbon\Carbon;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class ConferenceProfileParamForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Conference Profile Param')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('profile_param_name')
                        ->label('Profile Param Name')->placeholder('profile param name'),
                    TextInput::make('profile_param_value')
                        ->label('Profile Param Value')->placeholder('profile param value'),
                    Select::make('profile_param_enabled')
                        ->label('Profile Param Enabled')
                        ->native(false)->options(['true'=>'Yes','false'=>'No'])->default('false'),
                    Textarea::make('profile_param_description')
                        ->label('Profile Param Description')->rows(2)->columnSpanFull(),
                                ]),
                        ]),
                ]),

            Section::make('Record Info')
                ->description('System identifiers — read only.')
                ->icon('heroicon-o-information-circle')
                ->collapsed()->columns(3)
                ->schema([
                    Placeholder::make('conference_profile_uuid')
                        ->label('UUID')
                        ->content(fn ($record) => $record?->conference_profile_uuid
                            ? new HtmlString('<code style="font-family:monospace;font-size:0.72rem;color:#8b95ab;word-break:break-all;">'.$record->conference_profile_uuid.'</code>')
                            : 'Assigned on save'),
                    Placeholder::make('insert_date')->label('Created')
                        ->content(fn ($record) => $record?->insert_date
                            ? Carbon::parse($record->insert_date)->format('M j, Y H:i') : '—'),
                    Placeholder::make('update_date')->label('Last Updated')
                        ->content(fn ($record) => $record?->update_date
                            ? Carbon::parse($record->update_date)->diffForHumans() : '—'),
                ])
                ->visibleOn('edit'),
        ]);
    }
}
