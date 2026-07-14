<?php
namespace App\Filament\Resources\Billing\Gateways\Schemas;

use App\Models\Billing\Account;
use Carbon\Carbon;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\DB;

class GatewayForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Section::make()->columns(2)->schema([

                Section::make('Basic Information')->columnSpan(1)->schema([
                    TextInput::make('name')
                        ->label('Name')->required()
                        ->placeholder('YourProvider'),

                    Select::make('sip_profile_id')
                        ->label('SIP Profile')
                        ->options(fn() => collect([0 => 'Default'])
                            ->merge(DB::table('sip_profiles')
                                ->where('status', 0)->pluck('name', 'id')->toArray()))
                        ->default(0),

                    Select::make('accountid')
                        ->label('Provider Account')
                        ->options(fn() => collect([0 => '-- None --'])
                            ->merge(Account::where('type', 2)->where('status', 0)
                                ->where('deleted', 0)
                                ->get()->mapWithKeys(fn($a) => [
                                    $a->id => $a->number . ' — ' . ($a->company_name ?: $a->first_name)
                                ])))
                        ->default(0)->searchable(),

                    Select::make('status')
                        ->options([0 => 'Active', 1 => 'Inactive'])
                        ->default(0),

                    TextInput::make('sip_username')->label('Username')->placeholder('USERNAME'),

                    TextInput::make('sip_password')
                        ->label('Password')->password()->revealable()
                        ->placeholder('PASSWORD'),

                    TextInput::make('sip_proxy')
                        ->label('Proxy/Host')->required()
                        ->placeholder('sip.provider.com'),

                    TextInput::make('sip_outbound_proxy')
                        ->label('Outbound-Proxy')->placeholder('optional'),

                    Select::make('sip_register')
                        ->label('Register')
                        ->options([0 => 'False', 1 => 'True'])
                        ->default(0),

                    Select::make('sip_caller_id_in_from')
                        ->label('Caller-Id-In-From')
                        ->options([1 => 'True', 0 => 'False'])
                        ->default(1),
                ]),

                Section::make('Optional Settings')->columnSpan(1)->schema([
                    TextInput::make('sip_from_domain')->label('From-Domain')->placeholder('optional'),
                    TextInput::make('sip_from_user')->label('From User')->placeholder('optional'),
                    TextInput::make('sip_realm')->label('Realm')->placeholder('optional'),

                    Select::make('sip_extension_in_contact')
                        ->label('Extension-In-Contact')
                        ->options([0 => 'False', 1 => 'True'])
                        ->default(0),

                    TextInput::make('sip_extension')->label('Extension')->placeholder('optional'),

                    TextInput::make('sip_expire_seconds')
                        ->label('Expire Seconds')->numeric()->default(800),

                    Select::make('sip_transport')
                        ->label('Transport')
                        ->options(['udp' => 'UDP', 'tcp' => 'TCP', 'tls' => 'TLS'])
                        ->default('udp'),

                    TextInput::make('sip_contact_params')
                        ->label('Contact Params')->placeholder('optional'),
                ]),
            ]),

            Section::make('Record Info')
                ->icon('heroicon-o-information-circle')
                ->collapsed()->columns(2)
                ->schema([
                    Placeholder::make('id_info')->label('Gateway ID')
                        ->content(fn($record) => $record?->id ?? '—'),
                    Placeholder::make('created')->label('Created')
                        ->content(fn($record) => $record?->created_date
                            ? Carbon::parse($record->created_date)->format('M j, Y H:i') : '—'),
                ])->visibleOn('edit'),
        ]);
    }
}
