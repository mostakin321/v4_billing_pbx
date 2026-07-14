<?php
namespace App\Filament\Resources\Billing\AccessNumbers\Pages;
use App\Filament\Resources\Billing\AccessNumbers\AccessNumberResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditAccessNumber extends EditRecord {
    protected static string $resource = AccessNumberResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
