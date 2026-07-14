<?php
namespace App\Filament\Resources\Billing\Rates\Pages;
use App\Filament\Resources\Billing\Rates\RateResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditRate extends EditRecord {
    protected static string $resource = RateResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
