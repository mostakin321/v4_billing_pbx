<?php

namespace App\Filament\Resources\FusionPBX\FifoMembers;

use App\Filament\Resources\FusionPBX\FifoMembers\Pages;
use App\Filament\Resources\FusionPBX\FifoMembers\Schemas;
use App\Filament\Resources\FusionPBX\FifoMembers\Tables;
use App\Models\FusionPBX\FifoMember;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class FifoMemberResource extends Resource
{
    protected static ?string $slug = 'fifo-member';
    protected static \UnitEnum|string|null $navigationGroup = 'Applications';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort = 16;
protected static ?string $model = FifoMember::class;
    protected static ?string $modelLabel = 'Fifo Member';

    protected static ?string $pluralModelLabel = 'Fifo Members';

    protected static ?string $recordTitleAttribute = 'fifo_member_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\FifoMemberForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\FifoMembersTable::configure($table);
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
            'index' => Pages\ListFifoMembers::route('/'),
            'create' => Pages\CreateFifoMember::route('/create'),
            'edit' => Pages\EditFifoMember::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Call Center';
    }

}
