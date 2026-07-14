<?php
namespace App\Filament\Resources\FusionPBX\Domains\Schemas;

use Carbon\Carbon;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class DomainForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([
            Section::make('Domain')->columns(2)->schema([
                TextInput::make('domain_name')
                    ->label('Domain Name')->required()
                    ->placeholder('e.g. 192.168.1.1 or sip.example.com'),
                Select::make('domain_enabled')
                    ->label('Enabled')
                    ->options(['true'=>'True','false'=>'False'])
                    ->default('true')->native(false),
                Textarea::make('domain_description')
                    ->label('Description')->rows(2)->columnSpanFull(),
            ]),
            Section::make('Record Info')
                ->description('System identifiers — read only.')
                ->collapsed()->columns(3)
                ->schema([
                    Placeholder::make('domain_uuid')->label('UUID')
                        ->content(fn ($record) => $record?->domain_uuid
                            ? new HtmlString('<code style="font-family:monospace;font-size:0.72rem;color:#8b95ab;">'.$record->domain_uuid.'</code>')
                            : 'Assigned on save'),
                    Placeholder::make('insert_date')->label('Created')
                        ->content(fn ($record) => $record?->insert_date
                            ? Carbon::parse($record->insert_date)->format('M j, Y H:i') : '—'),
                    Placeholder::make('update_date')->label('Updated')
                        ->content(fn ($record) => $record?->update_date
                            ? Carbon::parse($record->update_date)->diffForHumans() : '—'),
                ])->visibleOn('edit'),
        ]);
    }
}
