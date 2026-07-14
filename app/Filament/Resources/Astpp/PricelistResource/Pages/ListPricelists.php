<?php
namespace App\Filament\Resources\Astpp\PricelistResource\Pages;

use App\Filament\Resources\Astpp\PricelistResource\PricelistResource;
use App\Models\Astpp\Pricelist;
use Filament\Actions\CreateAction;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\DB;

class ListPricelists extends ListRecords
{
    protected static string $resource = PricelistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Create'),

            Action::make('duplicate')
                ->label('Duplicate')
                ->icon('heroicon-o-document-duplicate')
                ->color('gray')
                ->form([
                    TextInput::make('new_name')
                        ->label('New Rate Group Name *')
                        ->required()
                        ->placeholder('Gold (Copy)'),

                    Select::make('source_id')
                        ->label('Rate Group *')
                        ->options(fn() => Pricelist::pluck('name', 'id'))
                        ->required()
                        ->searchable()
                        ->helperText('Select rate group to copy settings and rates from'),
                ])
                ->modalHeading('Duplicate Rate Group')
                ->action(function (array $data) {
                    $source = Pricelist::findOrFail($data['source_id']);

                    // Duplicate pricelist
                    $new = $source->replicate();
                    $new->name = $data['new_name'];
                    $new->creation_date = now();
                    $new->last_modified_date = now();
                    $new->save();

                    // Duplicate routes (rates)
                    $routes = DB::table('routes')->where('pricelist_id', $source->id)->get();
                    foreach ($routes as $route) {
                        $routeArr = (array) $route;
                        unset($routeArr['id']);
                        $routeArr['pricelist_id']       = $new->id;
                        $routeArr['creation_date']      = now();
                        $routeArr['last_modified_date'] = now();
                        DB::table('routes')->insert($routeArr);
                    }

                    \Filament\Notifications\Notification::make()
                        ->title('Rate Group duplicated successfully!')
                        ->success()
                        ->send();
                }),
        ];
    }
}
