<?php
namespace App\Filament\Resources\Astpp\DidResource\Pages;
use App\Filament\Resources\Astpp\DidResource\DidResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditDid extends EditRecord {
    protected static string $resource = DidResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
