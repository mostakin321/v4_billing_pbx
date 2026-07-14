<?php

namespace App\Filament\Resources\FusionPBX\FaxQueues;

use App\Filament\Resources\FusionPBX\FaxQueues\Pages;
use App\Filament\Resources\FusionPBX\FaxQueues\Schemas;
use App\Filament\Resources\FusionPBX\FaxQueues\Tables;
use App\Models\FusionPBX\FaxQueue;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class FaxQueueResource extends Resource
{
    protected static ?string $slug = 'fax-queue';
    protected static \UnitEnum|string|null $navigationGroup = 'Fax';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-queue-list';
    protected static ?int $navigationSort = 2;
protected static ?string $model = FaxQueue::class;
    protected static ?string $modelLabel = 'Fax Queue';

    protected static ?string $pluralModelLabel = 'Fax Queues';

    protected static ?string $recordTitleAttribute = 'fax_queue_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\FaxQueueForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\FaxQueuesTable::configure($table);
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
            'index' => Pages\ListFaxQueues::route('/'),
            'create' => Pages\CreateFaxQueue::route('/create'),
            'edit' => Pages\EditFaxQueue::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
