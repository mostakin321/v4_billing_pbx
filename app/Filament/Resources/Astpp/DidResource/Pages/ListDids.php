<?php
namespace App\Filament\Resources\Astpp\DidResource\Pages;
use App\Filament\Resources\Astpp\DidResource\DidResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDids extends ListRecords
{
    protected static string $resource = DidResource::class;

    public function getTitle(): string { return 'DIDs'; }

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()->label('New DID')];
    }
}
