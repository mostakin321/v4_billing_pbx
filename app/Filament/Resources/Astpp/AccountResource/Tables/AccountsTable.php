<?php

namespace App\Filament\Resources\Astpp\AccountResource\Tables;

use App\Models\Astpp\Account;
use App\Models\Astpp\BillingTransaction;
use App\Services\Billing\BillingService;
use App\Services\Billing\CGRatesService;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Support\Enums\FontWeight;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class AccountsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('number')
                    ->label('Account')
                    ->searchable()->sortable()
                    ->weight(FontWeight::Bold)
                    ->copyable(),

                TextColumn::make('company_name')
                    ->label('Company')
                    ->searchable()->default('—'),

                TextColumn::make('first_name')
                    ->label('Name')
                    ->formatStateUsing(fn ($record) => trim($record->first_name . ' ' . $record->last_name) ?: '—')
                    ->searchable(),

                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ((int) $state) {
                        -1 => 'Admin', 3 => 'Reseller', 0 => 'Customer', 2 => 'Provider', default => '?'
                    })
                    ->color(fn ($state) => match ((int) $state) {
                        -1 => 'danger', 3 => 'warning', 0 => 'success', 2 => 'info', default => 'gray'
                    }),

                TextColumn::make('balance')
                    ->money('USD')->sortable()
                    ->color(fn ($record) => (float) $record->balance >= 0 ? 'success' : 'danger')
                    ->weight(FontWeight::Bold),

                TextColumn::make('credit_limit')
                    ->label('Credit')
                    ->money('USD'),

                TextColumn::make('pricelist.name')
                    ->label('Rate Plan')
                    ->badge()->color('info')
                    ->default('—'),

                TextColumn::make('reseller.company_name')
                    ->label('Reseller')
                    ->default('—')->color('gray'),

                TextColumn::make('extension')->default('—'),

                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state == 0 ? 'Active' : 'Inactive')
                    ->color(fn ($state) => $state == 0 ? 'success' : 'danger'),
            ])

            ->filters([
                SelectFilter::make('type')
                    ->label('Type')
                    ->options([-1 => 'Admin', 3 => 'Reseller', 0 => 'Customer', 2 => 'Provider']),

                SelectFilter::make('status')
                    ->options([0 => 'Active', 1 => 'Inactive']),
            ])

            ->actions([
                // ── Top-Up ───────────────────────────────────────────────
                Action::make('topup')
                    ->label('Top Up')
                    ->icon('heroicon-o-plus-circle')
                    ->color('success')
                    ->form([
                        TextInput::make('amount')
                            ->label('Amount (USD)')
                            ->numeric()->required()
                            ->minValue(0.01)
                            ->placeholder('50.00'),

                        Select::make('type')
                            ->label('Transaction Type')
                            ->options([
                                'topup'      => 'Top Up (cash)',
                                'credit'     => 'Credit (free)',
                                'adjustment' => 'Manual Adjustment',
                                'refund'     => 'Refund',
                                'bonus'      => 'Bonus',
                            ])
                            ->default('topup')->required(),

                        TextInput::make('description')
                            ->label('Note')
                            ->placeholder('Bank transfer ref #')
                            ->maxLength(256),
                    ])
                    ->action(function (array $data, Account $record): void {
                        $billing = app(BillingService::class);
                        $amount  = (float) $data['amount'];
                        $billing->credit(
                            $record,
                            $amount,
                            $data['description'] ?? 'Manual top-up via Filament',
                            $data['type']
                        );

                        Notification::make()
                            ->title('Balance Updated')
                            ->body("Added $" . number_format($amount, 2) . " to {$record->number}. New balance: $" . number_format((float) $record->fresh()->balance, 5))
                            ->success()->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading(fn (Account $record) => "Top Up: {$record->number}")
                    ->modalDescription(fn (Account $record) => 'Current balance: $' . number_format((float) $record->balance, 5)),

                // ── Deduct ───────────────────────────────────────────────
                Action::make('deduct')
                    ->label('Deduct')
                    ->icon('heroicon-o-minus-circle')
                    ->color('warning')
                    ->form([
                        TextInput::make('amount')
                            ->label('Amount (USD)')
                            ->numeric()->required()->minValue(0.01),

                        Select::make('type')
                            ->options([
                                'call'       => 'Call Charge',
                                'adjustment' => 'Manual Adjustment',
                                'charge'     => 'Service Charge',
                                'did'        => 'DID Fee',
                            ])
                            ->default('adjustment')->required(),

                        TextInput::make('description')
                            ->label('Note')
                            ->placeholder('Monthly DID fee')
                            ->maxLength(256),
                    ])
                    ->action(function (array $data, Account $record): void {
                        $billing = app(BillingService::class);
                        $amount  = (float) $data['amount'];
                        $billing->debit(
                            $record,
                            $amount,
                            $data['type'],
                            $data['description'] ?? 'Manual deduction via Filament'
                        );

                        Notification::make()
                            ->title('Balance Deducted')
                            ->body("Deducted $" . number_format($amount, 2) . " from {$record->number}.")
                            ->warning()->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading(fn (Account $record) => "Deduct from: {$record->number}"),

                

                

                EditAction::make(),
                DeleteAction::make(),
            ])

            // ── Bulk actions ─────────────────────────────────────────────
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('bulk_cgr_sync')
                        ->label('Sync All to CGRateS')
                        ->icon('heroicon-o-arrow-path')
                        ->action(function (Collection $records): void {
                            $cgr = app(CGRatesService::class);
                            $ok = $fail = 0;
                            foreach ($records as $record) {
                                $cgr->syncAccount($record) ? $ok++ : $fail++;
                            }
                            Notification::make()
                                ->title('CGRateS Bulk Sync')
                                ->body("Synced: {$ok} | Failed: {$fail}")
                                ->success()->send();
                        })
                        ->requiresConfirmation()
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])

            ->defaultSort('number');
    }
}
