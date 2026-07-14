<?php
namespace App\Filament\Resources\Billing\Calltypes\Pages;
use App\Filament\Resources\Billing\Calltypes\CalltypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditCalltype extends EditRecord {
    protected static string $resource = CalltypeResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
