<?php

namespace App\Filament\Resources\FusionPBX\DialplanDetails\Schemas;

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

class DialplanDetailForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Dialplan Detail')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('dialplan_detail_tag')
                        ->label('Detail Tag')->placeholder('detail tag'),
                    TextInput::make('dialplan_detail_type')
                        ->label('Detail Type')->placeholder('detail type'),
                    TextInput::make('dialplan_detail_data')
                        ->label('Detail Data')->placeholder('detail data'),
                    TextInput::make('dialplan_detail_break')
                        ->label('Detail Break')->placeholder('detail break'),
                    TextInput::make('dialplan_detail_inline')
                        ->label('Detail Inline')->placeholder('detail inline'),
                    TextInput::make('dialplan_detail_group')
                        ->label('Detail Group')->placeholder('detail group'),
                    Select::make('dialplan_detail_enabled')
                        ->label('Detail Enabled')
                        ->native(false)->options(['true'=>'Yes','false'=>'No'])->default('false'),
                                ]),
                        ]),

                    Tabs\Tab::make('Advanced')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            Section::make('Advanced')
                                ->columns(2)
                                ->schema([
                    TextInput::make('dialplan_detail_order')
                        ->label('Detail Order')
                        ->numeric(),
                                ]),
                        ]),
                ]),

            Section::make('Record Info')
                ->description('System identifiers — read only.')
                ->icon('heroicon-o-information-circle')
                ->collapsed()->columns(3)
                ->schema([
                    Placeholder::make('domain_uuid')
                        ->label('UUID')
                        ->content(fn ($record) => $record?->domain_uuid
                            ? new HtmlString('<code style="font-family:monospace;font-size:0.72rem;color:#8b95ab;word-break:break-all;">'.$record->domain_uuid.'</code>')
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
