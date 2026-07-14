<?php
namespace App\Filament\Resources\Astpp\AccessNumberResource\Pages;
use App\Filament\Resources\Astpp\AccessNumberResource\AccessNumberResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
class ListAccessNumbers extends ListRecords {
    protected static string $resource = AccessNumberResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}
