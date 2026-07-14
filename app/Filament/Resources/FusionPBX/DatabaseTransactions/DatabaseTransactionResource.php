<?php

namespace App\Filament\Resources\FusionPBX\DatabaseTransactions;

use App\Filament\Resources\FusionPBX\DatabaseTransactions\Pages;
use App\Filament\Resources\FusionPBX\DatabaseTransactions\Schemas;
use App\Filament\Resources\FusionPBX\DatabaseTransactions\Tables;
use App\Models\FusionPBX\DatabaseTransaction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class DatabaseTransactionResource extends Resource
{
    protected static ?string $slug = 'database-transaction';
    protected static \UnitEnum|string|null $navigationGroup = 'Advanced';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-arrow-path';
    protected static ?int $navigationSort = 12;
protected static ?string $model = DatabaseTransaction::class;
    protected static ?string $modelLabel = 'Database Transaction';

    protected static ?string $pluralModelLabel = 'Database Transactions';

    protected static ?string $recordTitleAttribute = 'database_transaction_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\DatabaseTransactionForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\DatabaseTransactionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDatabaseTransactions::route('/'),
            'create' => Pages\CreateDatabaseTransaction::route('/create'),
            'edit' => Pages\EditDatabaseTransaction::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Reports';
    }

}
