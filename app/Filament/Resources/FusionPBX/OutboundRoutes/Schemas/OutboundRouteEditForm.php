<?php

namespace App\Filament\Resources\FusionPBX\OutboundRoutes\Schemas;

use Carbon\Carbon;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class OutboundRouteEditForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([
            Tabs::make('Outbound Route')->columnSpanFull()->tabs([

                Tabs\Tab::make('Main')->icon('heroicon-o-arrow-up-on-square')->schema([
                    Section::make('Route Identity')->columns(3)->schema([
                        TextInput::make('dialplan_name')
                            ->label('Dialplan Name')->required()->columnSpan(2),
                        Select::make('dialplan_enabled')
                            ->label('Status')
                            ->options(['true' => 'Enabled', 'false' => 'Disabled'])
                            ->default('true')->native(false),
                        Select::make('dialplan_context')
                            ->label('Context')
                            ->searchable()
                            ->placeholder('domain name (e.g. pbx.example.com)')
                            ->options(function () {
                                try {
                                    return \App\Models\FusionPBX\Domain::where('domain_enabled', true)
                                        ->pluck('domain_name', 'domain_name')->toArray();
                                } catch (\Exception $e) {
                                    return [];
                                }
                            })
                            ->columnSpan(2),
                        TextInput::make('dialplan_order')
                            ->label('Priority Order')->numeric()->placeholder('300'),
                    ]),
                    Section::make('Condition & Action')->columns(2)->schema([
                        TextInput::make('dialplan_number')
                            ->label('Number Pattern')
                            ->placeholder('^(?:\+1|1)?([2-9]\d{9})$')
                            ->helperText('Regex matched against destination_number.'),
                        Textarea::make('dialplan_xml')
                            ->label('Dialplan XML')
                            ->rows(5)->columnSpanFull()
                            ->helperText('Raw XML — auto-generated, edit with care.')
                            ->extraInputAttributes([
                                'class' => 'font-mono text-sm',
                                'spellcheck' => 'false',
                            ]),
                        Textarea::make('dialplan_description')
                            ->label('Description')->rows(2)->columnSpanFull(),
                    ]),
                ]),

                Tabs\Tab::make('Advanced')->icon('heroicon-o-cog-6-tooth')->schema([
                    Section::make('Advanced Settings')->columns(2)->schema([
                        Select::make('dialplan_continue')
                            ->label('Continue on Match')
                            ->options(['true' => 'Yes — continue', 'false' => 'No — stop'])
                            ->default('false')->native(false),
                        TextInput::make('dialplan_destination')
                            ->label('Destination')
                            ->placeholder('Destination number or variable'),
                        TextInput::make('hostname')
                            ->label('Hostname Override')
                            ->placeholder('Leave empty for all servers'),
                    ]),
                ]),
            ]),

            Section::make('Record Info')->description('System identifiers — read only.')
                ->icon('heroicon-o-information-circle')->collapsed()->columns(3)
                ->schema([
                    Placeholder::make('dialplan_uuid')->label('UUID')
                        ->content(fn($r) => $r?->dialplan_uuid
                            ? new HtmlString('<code style="font-family:monospace;font-size:0.72rem;color:#8b95ab;word-break:break-all;">'.$r->dialplan_uuid.'</code>')
                            : 'Assigned on save'),
                    Placeholder::make('insert_date')->label('Created')
                        ->content(fn($r) => $r?->insert_date ? Carbon::parse($r->insert_date)->format('M j, Y H:i') : '—'),
                    Placeholder::make('update_date')->label('Updated')
                        ->content(fn($r) => $r?->update_date ? Carbon::parse($r->update_date)->diffForHumans() : '—'),
                ])->visibleOn('edit'),
        ]);
    }
}
