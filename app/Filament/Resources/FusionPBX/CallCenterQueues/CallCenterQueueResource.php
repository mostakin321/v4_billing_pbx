<?php

namespace App\Filament\Resources\FusionPBX\CallCenterQueues;

use App\Filament\Resources\FusionPBX\CallCenterQueues\Pages;
use App\Filament\Resources\FusionPBX\CallCenterQueues\Schemas;
use App\Filament\Resources\FusionPBX\CallCenterQueues\Tables;
use App\Models\FusionPBX\CallCenterQueue;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class CallCenterQueueResource extends Resource
{
    protected static ?string $slug = 'call-center-queue';
    protected static \UnitEnum|string|null $navigationGroup = 'Call Center';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-phone-arrow-down-left';
    protected static ?int $navigationSort = 1;
protected static ?string $model = CallCenterQueue::class;
    protected static ?string $modelLabel = 'Call Center Queue';

    protected static ?string $pluralModelLabel = 'Call Center Queues';

    protected static ?string $recordTitleAttribute = 'queue_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\CallCenterQueueForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\CallCenterQueuesTable::configure($table);
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
            'index' => Pages\ListCallCenterQueues::route('/'),
            'create' => Pages\CreateCallCenterQueue::route('/create'),
            'edit' => Pages\EditCallCenterQueue::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Call Center';
    }

}
