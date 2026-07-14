<?php
namespace App\Filament\Resources\Astpp\RatedeckResource\Pages;
use App\Filament\Resources\Astpp\RatedeckResource\RatedeckResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditRatedeck extends EditRecord {
    protected static string $resource = RatedeckResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
