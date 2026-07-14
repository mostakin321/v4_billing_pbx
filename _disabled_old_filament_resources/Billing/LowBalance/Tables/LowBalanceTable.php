<?php
namespace App\Filament\Resources\Billing\LowBalance\Tables;

use App\Models\Billing\Account;
use App\Models\Billing\BillingTransaction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Support\Enums\FontWeight;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

class LowBalanceTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('number')->label('Account')->searchable()->weight(FontWeight::Bold),
                TextColumn::make('company_name')->label('Company')->searchable()->default('—'),
                TextColumn::make('reseller.company_name')->label('Reseller')->default('—')->badge()->color('purple'),
                TextColumn::make('type')->badge()
                    ->formatStateUsing(fn(string $state): string => match((int)$state) {
                        -1=>'Admin',3=>'Reseller',0=>'Customer',default=>'?'
                    })
                    ->color(fn(string $state): string => match((int)$state) {
                        3=>'warning',0=>'info',default=>'gray'
                    }),
                TextColumn::make('balance')
                    ->money('usd')->sortable()
                    ->color('danger')
                    ->weight(FontWeight::Bold),
                TextColumn::make('notify_credit_limit')
                    ->label('Alert Threshold')
                    ->money('usd')->color('warning'),
                TextColumn::make('email')->label('Email')->color('gray'),
            ])
            ->actions([
                Action::make('topup')
                    ->label('Top Up')
                    ->icon('heroicon-o-plus-circle')
                    ->color('success')
                    ->form([
                        TextInput::make('amount')->label('Amount ($)')->numeric()->required()->minValue(0.01),
                        Select::make('type')->options(['topup'=>'Top Up','credit'=>'Credit','refund'=>'Refund'])->default('topup'),
                        TextInput::make('description')->label('Note')->placeholder('Top up to resolve low balance'),
                    ])
                    ->action(function (array $data, Account $record): void {
                        $amount = (float)$data['amount'];
                        $before = (float)$record->balance;
                        $after  = $before + $amount;
                        DB::transaction(function() use ($record, $data, $amount, $before, $after) {
                            $record->update(['balance' => $after]);
                            BillingTransaction::create([
                                'account_id'     => $record->id,
                                'type'           => $data['type'],
                                'amount'         => $amount,
                                'balance_before' => $before,
                                'balance_after'  => $after,
                                'description'    => $data['description'] ?? 'Top up',
                                'reference_type' => $data['type'],
                                'created_at'     => now(),
                            ]);
                        });
                        Notification::make()
                            ->title("Topped up {$record->number}")
                            ->body("Added \${$amount}. New balance: \${$after}")
                            ->success()->send();
                    })
                    ->modalHeading(fn(Account $r) => "Top Up: {$r->number} (Balance: \${$r->balance})")
                    ->requiresConfirmation(),
            ])
            ->defaultSort('balance')
            ->poll('60s');
    }
}
