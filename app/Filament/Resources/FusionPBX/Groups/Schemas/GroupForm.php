<?php
namespace App\Filament\Resources\FusionPBX\Groups\Schemas;

use Carbon\Carbon;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class GroupForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([
            Section::make('Group')->columns(2)->schema([
                TextInput::make('group_name')
                    ->label('Group Name')->required()
                    ->placeholder('e.g. admin, user, agent'),
                TextInput::make('group_level')
                    ->label('Group Level')->numeric()
                    ->placeholder('e.g. 10, 20, 30, 50, 80')
                    ->helperText('public=10, agent/fax=20, user=30, admin=50, superadmin=80'),
                Select::make('group_protected')
                    ->label('Protected')
                    ->options(['true'=>'True','false'=>'False'])
                    ->default('false')->native(false),
                Textarea::make('group_description')
                    ->label('Description')->rows(2)->columnSpanFull(),
            ]),
            Section::make('Record Info')
                ->description('System identifiers — read only.')
                ->collapsed()->columns(3)
                ->schema([
                    Placeholder::make('group_uuid')->label('UUID')
                        ->content(fn ($record) => $record?->group_uuid
                            ? new HtmlString('<code style="font-family:monospace;font-size:0.72rem;color:#8b95ab;">'.$record->group_uuid.'</code>')
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
