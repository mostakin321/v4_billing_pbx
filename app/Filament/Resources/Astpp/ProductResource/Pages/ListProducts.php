<?php
namespace App\Filament\Resources\Astpp\ProductResource\Pages;
use App\Filament\Resources\Astpp\ProductResource\ProductResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
class ListProducts extends ListRecords {
    protected static string $resource = ProductResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}
