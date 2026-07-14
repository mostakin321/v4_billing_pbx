<?php
namespace App\Filament\Resources\Billing\AniMaps\Pages;
use App\Filament\Resources\Billing\AniMaps\AniMapResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
class ListAniMaps extends ListRecords {
    protected static string $resource = AniMapResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}
