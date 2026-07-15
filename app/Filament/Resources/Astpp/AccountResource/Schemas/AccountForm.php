<?php
namespace App\Filament\Resources\Astpp\AccountResource\Schemas;

use App\Models\Astpp\Account;
use App\Models\Astpp\Pricelist;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AccountForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([
            Tabs::make('Account')->columnSpanFull()->tabs([

                // ── Basic Info ───────────────────────────────────────────────
                Tabs\Tab::make('Basic Info')->icon('heroicon-o-user')->schema([
                    Section::make('Account Details')->columns(3)->schema([

                        Hidden::make('type')
                            ->default(Account::TYPE_CUSTOMER),

                        Select::make('fusion_user_uuid')
                            ->label('Account Type')
                            ->placeholder('Select Account / User')
                            ->options(fn (): array => DB::connection('fusion')
                                ->table('v_users')
                                ->where('user_enabled', 1)
                                ->orderBy('username')
                                ->pluck('username', 'user_uuid')
                                ->all())
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (?string $state, Set $set): void {
                                $set('number', null);
                                $set('extension_uuid', null);
                                $set('domain_uuid', null);

                                if (blank($state)) {
                                    return;
                                }

                                $user = DB::connection('fusion')
                                    ->table('v_users')
                                    ->where('user_uuid', $state)
                                    ->first();

                                if (! $user) {
                                    return;
                                }

                                $set('domain_uuid', $user->domain_uuid);

                                if (! empty($user->user_email)) {
                                    $set('email', $user->user_email);
                                }
                            }),

                        Select::make('number')
                            ->label('Account Number')
                            ->placeholder('Select Account Number')
                            ->options(function (Get $get): array {
                                $userUuid = $get('fusion_user_uuid');

                                if (blank($userUuid)) {
                                    return [];
                                }

                                $domainUuid = DB::connection('fusion')
                                    ->table('v_users')
                                    ->where('user_uuid', $userUuid)
                                    ->value('domain_uuid');

                                if (blank($domainUuid)) {
                                    return [];
                                }

                                return DB::connection('fusion')
                                    ->table('v_extensions')
                                    ->where('domain_uuid', $domainUuid)
                                    ->whereRaw(
                                        "LOWER(CAST(enabled AS TEXT)) IN ('1', 'true', 'yes')"
                                    )
                                    ->orderBy('extension')
                                    ->pluck('extension', 'extension')
                                    ->all();
                            })
                            ->disabled(fn (Get $get): bool =>
                                blank($get('fusion_user_uuid'))
                            )
                            ->searchable()
                            ->required()
                            ->live()
                            ->afterStateUpdated(
                                function (?string $state, Get $get, Set $set): void {
                                    $set('extension_uuid', null);

                                    if (blank($state)) {
                                        return;
                                    }

                                    $extensionUuid = DB::connection('fusion')
                                        ->table('v_extensions')
                                        ->where(
                                            'domain_uuid',
                                            $get('domain_uuid')
                                        )
                                        ->where('extension', $state)
                                        ->value('extension_uuid');

                                    $set('extension_uuid', $extensionUuid);
                                }
                            ),

                        Hidden::make('domain_uuid'),
                        Hidden::make('extension_uuid'),

                        Select::make('reseller_id')->label('Reseller')
                            ->options(fn() => Account::where('type',3)
                                ->where('status',0)->where('deleted',0)
                                ->pluck('company_name','id'))
                            ->nullable()->searchable()
                            ->placeholder('-- None (Admin) --')
                            ->helperText('Leave blank if directly under admin')
                            ->dehydrateStateUsing(fn($state) => $state ?: 0)
                            ->afterStateHydrated(fn($component, $state) => $component->state($state ?: null)),

                        TextInput::make('first_name')->label('First Name')->placeholder('John'),
                        TextInput::make('last_name')->label('Last Name')->placeholder('Doe'),
                        TextInput::make('company_name')->label('Company')->placeholder('ACME Ltd'),
                        TextInput::make('email')->email()->placeholder('user@example.com'),
                        TextInput::make('notification_email')->label('Notification Email')->email()->nullable(),
                        TextInput::make('telephone_1')->label('Phone 1')->placeholder('+880...'),
                        TextInput::make('telephone_2')->label('Phone 2')->nullable(),
                    ]),

                    Section::make('Address')->columns(3)->schema([
                        TextInput::make('address_1')->label('Address 1'),
                        TextInput::make('address_2')->label('Address 2')->nullable(),
                        TextInput::make('city'),
                        TextInput::make('province')->label('State/Province'),
                        TextInput::make('postal_code')->label('Postal Code'),
                        Select::make('country_id')->label('Country')
                            ->options(fn() => DB::table('countrycode')->orderBy('country')->pluck('country','id'))
                            ->searchable()->default(0),
                        TextInput::make('tax_number')->label('Tax/VAT Number')->nullable(),
                        TextInput::make('reference')->label('Reference')->nullable(),
                    ]),
                ]),

                // ── Billing Settings ─────────────────────────────────────────
                Tabs\Tab::make('Billing Settings')->icon('heroicon-o-currency-dollar')->schema([
                    Section::make('Billing')->columns(3)->schema([

                        Select::make('posttoexternal')->label('Account Type')
                            ->options([0=>'Prepaid', 1=>'Postpaid'])
                            ->default(0),

                        TextInput::make('credit_limit')->label('Credit Limit')
                            ->numeric()->default(0),

                        TextInput::make('balance')->label('Balance')
                            ->numeric()->default(0),

                        Select::make('pricelist_id')->label('Rate Group *')
                            ->options(fn() => Pricelist::where('status',0)->pluck('name','id'))
                            ->required()->searchable(),

                        Select::make('status')->label('Status')
                            ->options([0=>'Active', 1=>'Inactive'])
                            ->default(0)->required(),

                        TextInput::make('maxchannels')->label('Max Channels')
                            ->numeric()->default(1),

                        TextInput::make('cps')->label('CPS (calls/sec)')
                            ->numeric()->default(0),

                        TextInput::make('notify_credit_limit')->label('Low Balance Alert ($)')
                            ->numeric()->default(0),

                        TextInput::make('notify_email')->label('Alert Email')
                            ->email()->nullable(),

                        TextInput::make('commission_rate')->label('Commission Rate (%)')
                            ->numeric()->default(0),

                        Select::make('is_recording')->label('Recording')
                            ->options([0=>'On', 1=>'Off'])->default(1),

                        Select::make('generate_invoice')->label('Generate Invoice')
                            ->options([0=>'No', 1=>'Yes'])->default(0),
                    ]),

                    Section::make('Invoice')->columns(3)->schema([
                        TextInput::make('invoice_day')->label('Invoice Day')
                            ->numeric()->default(0),
                        TextInput::make('invoice_interval')->label('Invoice Interval (days)')
                            ->numeric()->nullable(),
                        Textarea::make('invoice_note')->label('Invoice Note')
                            ->rows(2)->nullable(),
                    ]),
                ]),

                // ── Advanced ─────────────────────────────────────────────────
                Tabs\Tab::make('Advanced')->icon('heroicon-o-cog-6-tooth')->schema([
                    Section::make('Access & Limits')->columns(3)->schema([
                        Select::make('allow_ip_management')->label('IP Management')
                            ->options([1=>'Allowed', 0=>'Not Allowed'])->default(1),
                        Select::make('local_call')->label('Local Call')
                            ->options([1=>'Enabled', 0=>'Disabled'])->default(1),
                        TextInput::make('local_call_cost')->label('Local Call Cost')
                            ->numeric()->default(0),
                        TextInput::make('validfordays')->label('Valid For Days')
                            ->numeric()->default(3652),
                        DateTimePicker::make('expiry')->label('Expiry Date')->nullable(),
                        TextInput::make('pin')->label('PIN')->nullable(),
                    ]),

                    Section::make('Localization')->columns(3)->schema([
                        Select::make('language_id')->label('Language')
                            ->options(fn() => collect(['0'=>'Default'])
                                ->merge(DB::table('language')->pluck('languagename','id')))
                            ->default(0),
                        Select::make('currency_id')->label('Currency')
                            ->options(fn() => collect(['0'=>'Default'])
                                ->merge(DB::table('currency')->pluck('currencyname','id')))
                            ->default(0)->searchable(),
                        Select::make('timezone_id')->label('Timezone')
                            ->options(fn() => collect(['0'=>'Default'])
                                ->merge(DB::table('timezone')->pluck('timezone_name','id')))
                            ->default(0)->searchable(),
                    ]),
                ]),

                // ── Info (edit only) ─────────────────────────────────────────
                Tabs\Tab::make('Info')->icon('heroicon-o-information-circle')
                    ->visibleOn('edit')->schema([
                    Section::make('Record Info')->columns(3)->schema([
                        Placeholder::make('id')->label('ID')
                            ->content(fn($record) => $record?->id ?? '—'),
                        Placeholder::make('creation')->label('Created')
                            ->content(fn($record) => $record?->creation
                                ? Carbon::parse($record->creation)->format('M j, Y H:i') : '—'),
                        Placeholder::make('balance_info')->label('Balance')
                            ->content(fn($record) => '$'.number_format($record?->balance ?? 0, 4)),
                    ]),
                ]),
            ]),
        ]);
    }
}
