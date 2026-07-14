<?php

namespace App\Filament\Resources\FusionPBX\SipProfileDomains\Schemas;

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

class SipProfileDomainForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Sip Profile Domain')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Advanced')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            Section::make('Advanced')
                                ->columns(2)
                                ->schema([
                    TextInput::make('sip_profile_domain_name')
                        ->label('Domain Name')->placeholder('domain name'),
                    TextInput::make('sip_profile_domain_alias')
                        ->label('Domain Alias')->placeholder('domain alias'),
                    TextInput::make('sip_profile_domain_parse')
                        ->label('Domain Parse')->placeholder('domain parse'),
                                ]),
                        ]),
                ]),

            Section::make('Record Info')
                ->description('System identifiers — read only.')
                ->icon('heroicon-o-information-circle')
                ->collapsed()->columns(3)
                ->schema([
                    Placeholder::make('sip_profile_uuid')
                        ->label('UUID')
                        ->content(fn ($record) => $record?->sip_profile_uuid
                            ? new HtmlString('<code style="font-family:monospace;font-size:0.72rem;color:#8b95ab;word-break:break-all;">'.$record->sip_profile_uuid.'</code>')
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
