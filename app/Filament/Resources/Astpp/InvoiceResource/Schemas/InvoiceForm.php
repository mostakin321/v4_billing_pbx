<?php
namespace App\Filament\Resources\Astpp\InvoiceResource\Schemas;
use Carbon\Carbon;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
class InvoiceForm {
    public static function configure(Schema $form): Schema {
        return $form->schema([
            Section::make('Invoice Details')->columns(3)->schema([
                Placeholder::make('number')->label('Invoice Number')
                    ->content(fn($record) => ($record?->prefix ?? '')  . ($record?->number ?? '—')),
                Placeholder::make('accountid')->label('Account ID')
                    ->content(fn($record) => $record?->accountid ?? '—'),
                Placeholder::make('status_info')->label('Status')
                    ->content(fn($record) => match((int)($record?->status ?? 0)){
                        0=>'Paid', 1=>'Unpaid', 2=>'Overdue', default=>'Unknown'
                    }),
                Placeholder::make('from_date')->label('From Date')
                    ->content(fn($record) => $record?->from_date
                        ? Carbon::parse($record->from_date)->format('M j, Y') : '—'),
                Placeholder::make('to_date')->label('To Date')
                    ->content(fn($record) => $record?->to_date
                        ? Carbon::parse($record->to_date)->format('M j, Y') : '—'),
                Placeholder::make('due_date')->label('Due Date')
                    ->content(fn($record) => $record?->due_date
                        ? Carbon::parse($record->due_date)->format('M j, Y') : '—'),
            ]),
        ]);
    }
}
