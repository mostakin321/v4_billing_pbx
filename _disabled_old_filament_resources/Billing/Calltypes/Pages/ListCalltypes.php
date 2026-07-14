<?php
namespace App\Filament\Resources\Billing\Calltypes\Pages;
use App\Filament\Resources\Billing\Calltypes\CalltypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
class ListCalltypes extends ListRecords {
    protected static string $resource = CalltypeResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}
