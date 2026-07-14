<?php
namespace App\Filament\Resources\Astpp\AccessNumberResource\Pages;
use App\Filament\Resources\Astpp\AccessNumberResource\AccessNumberResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditAccessNumber extends EditRecord {
    protected static string $resource = AccessNumberResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
