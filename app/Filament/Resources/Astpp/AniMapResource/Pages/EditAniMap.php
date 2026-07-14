<?php
namespace App\Filament\Resources\Astpp\AniMapResource\Pages;
use App\Filament\Resources\Astpp\AniMapResource\AniMapResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditAniMap extends EditRecord {
    protected static string $resource = AniMapResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
