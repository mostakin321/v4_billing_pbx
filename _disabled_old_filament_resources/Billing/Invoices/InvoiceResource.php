<?php
namespace App\Filament\Resources\Billing\Invoices;
use App\Models\Billing\Invoice;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
class InvoiceResource extends Resource {
    protected static ?string $model           = Invoice::class;
    public static function getNavigationGroup(): ?string { return 'CDRs & Billing'; }

    public static function getNavigationIcon(): string|\Illuminate\Contracts\Support\Htmlable|null { return 'heroicon-o-document-currency-dollar'; }
    public static function getNavigationLabel(): string { return 'Invoices'; }
    public static function getNavigationSort(): ?int { return 2; }
    public static function getModelLabel(): string { return 'Invoice'; }
    public static function getPluralModelLabel(): string { return 'Invoices'; }
    public static function form(Schema $form): Schema { return Schemas\InvoiceForm::configure($form); }
    public static function table(Table $table): Table { return Tables\InvoicesTable::configure($table); }
    public static function canCreate(): bool { return false; }
    public static function getRelations(): array { return []; }
    public static function getPages(): array {
        return [
            'index' => Pages\ListInvoices::route('/'),
            'edit'  => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
