<?php
namespace App\Filament\Resources\Billing\AccessNumbers\Pages;
use App\Filament\Resources\Billing\AccessNumbers\AccessNumberResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
class ListAccessNumbers extends ListRecords {
    protected static string $resource = AccessNumberResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}
