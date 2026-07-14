<?php
namespace App\Filament\Resources\Astpp\ProductResource\Pages;
use App\Filament\Resources\Astpp\ProductResource\ProductResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditProduct extends EditRecord {
    protected static string $resource = ProductResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
