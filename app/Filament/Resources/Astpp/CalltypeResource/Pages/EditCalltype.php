<?php
namespace App\Filament\Resources\Astpp\CalltypeResource\Pages;
use App\Filament\Resources\Astpp\CalltypeResource\CalltypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditCalltype extends EditRecord {
    protected static string $resource = CalltypeResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
