<?php
namespace App\Filament\Resources\Billing\AniMaps\Pages;
use App\Filament\Resources\Billing\AniMaps\AniMapResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditAniMap extends EditRecord {
    protected static string $resource = AniMapResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
