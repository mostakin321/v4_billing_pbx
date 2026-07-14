<?php
namespace App\Filament\Customer\Resources\Invoices;

use App\Models\Billing\Invoice;
use App\Filament\Customer\Resources\Invoices\Pages\ListCustomerInvoices;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class CustomerInvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    public static function getNavigationIcon(): string|\Illuminate\Contracts\Support\Htmlable|null { return 'heroicon-o-document-text'; }
    public static function getNavigationLabel(): string { return 'Invoices'; }
    public static function getNavigationSort(): ?int { return 3; }
    public static function canCreate(): bool { return false; }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $customer = auth('customer')->user();
        return parent::getEloquentQuery()->where('accountid', $customer->id);
    }

    public static function form(Schema $form): Schema { return $form->schema([]); }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('invoiceid')->label('Invoice #')->sortable()->copyable(),
            TextColumn::make('invoice_date')->label('Date')->dateTime('M j, Y')->sortable(),
            TextColumn::make('amount')->label('Amount')->money('usd'),
            TextColumn::make('balance')->label('Balance')->money('usd'),
            TextColumn::make('status')->badge()
                ->formatStateUsing(fn($state): string => $state == 1 ? 'Paid' : 'Unpaid')
                ->color(fn($state): string => $state == 1 ? 'success' : 'warning'),
            TextColumn::make('due_date')->label('Due Date')->dateTime('M j, Y'),
        ])
        ->defaultSort('invoice_date','desc');
    }

    public static function getPages(): array
    {
        return ['index' => ListCustomerInvoices::route('/')];
    }
}
