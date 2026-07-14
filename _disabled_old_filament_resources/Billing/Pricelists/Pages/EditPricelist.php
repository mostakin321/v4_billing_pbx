<?php
namespace App\Filament\Resources\Billing\Pricelists\Pages;
use App\Filament\Resources\Billing\Pricelists\PricelistResource;
use App\Models\Billing\Rate;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;

class EditPricelist extends EditRecord {
    protected static string $resource = PricelistResource::class;

    protected function getHeaderActions(): array {
        return [
            Action::make('manage_rates')
                ->label('Manage Rates')
                ->icon('heroicon-o-currency-dollar')
                ->color('info')
                ->form([
                    Repeater::make('rates')
                        ->label('Prefixes & Rates')
                        ->schema([
                            TextInput::make('prefix')->required()->placeholder('8801')
                                ->live(debounce: 500)
                                ->afterStateUpdated(function ($state, $set) {
                                    if (!$state) return;
                                    for ($i = strlen($state); $i >= 1; $i--) {
                                        $d = DB::table('prefix_destinations')
                                            ->where('prefix', substr($state, 0, $i))->first();
                                        if ($d) { $set('destination', $d->destination); $set('country_code', $d->country_code); break; }
                                    }
                                }),
                            TextInput::make('destination')->placeholder('Auto-filled'),
                            TextInput::make('rate')->label('Rate/Min $')->numeric()->required()->default(0),
                            TextInput::make('connectcost')->label('Connect $')->numeric()->default(0),
                            TextInput::make('initblock')->label('Init(s)')->numeric()->default(60),
                            TextInput::make('increment')->label('Inc(s)')->numeric()->default(1),
                            Select::make('traffic_type')->options(['cli'=>'CLI','noncli'=>'Non-CLI','ipphone'=>'IP Phone'])->default('cli'),
                            TextInput::make('country_code')->label('CC')->maxLength(5),
                        ])
                        ->columns(8)
                        ->addActionLabel('+ Add Prefix')
                        ->default(fn() => Rate::where('pricelist_id', $this->record->id)->get()
                            ->map(fn($r) => ['prefix'=>$r->prefix,'destination'=>$r->destination,
                                'rate'=>$r->rate,'connectcost'=>$r->connectcost,
                                'initblock'=>$r->initblock,'increment'=>$r->increment,
                                'traffic_type'=>$r->traffic_type??'cli','country_code'=>$r->country_code??''])
                            ->toArray()),
                ])
                ->action(function (array $data): void {
                    $pid = $this->record->id;
                    $prefixes = collect($data['rates'])->pluck('prefix')->toArray();
                    Rate::where('pricelist_id', $pid)->whereNotIn('prefix', $prefixes)->delete();
                    foreach ($data['rates'] as $row) {
                        Rate::updateOrCreate(
                            ['pricelist_id'=>$pid,'prefix'=>$row['prefix']],
                            ['destination'=>$row['destination']??'','rate'=>$row['rate'],
                             'connectcost'=>$row['connectcost']??0,'initblock'=>$row['initblock']??60,
                             'increment'=>$row['increment']??1,'traffic_type'=>$row['traffic_type']??'cli',
                             'country_code'=>$row['country_code']??'','status'=>0]
                        );
                    }
                    Notification::make()->title('Saved '.count($data['rates']).' rate(s)')->success()->send();
                }),

            Action::make('import_csv')
                ->label('Import CSV')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('gray')
                ->form([
                    Textarea::make('csv_data')
                        ->label('Paste CSV: prefix,rate,initblock,increment,destination')
                        ->placeholder("880,0.015,60,6\n8801,0.025,60,1\n88013,0.028,60,6")
                        ->rows(10)->required(),
                    Select::make('traffic_type')->options(['cli'=>'CLI','noncli'=>'Non-CLI','ipphone'=>'IP Phone'])->default('cli'),
                    Select::make('overwrite')->options(['update'=>'Update existing','skip'=>'Skip existing'])->default('update'),
                ])
                ->action(function (array $data): void {
                    $pid = $this->record->id;
                    $imported = $skipped = 0;
                    foreach (explode("\n", trim($data['csv_data'])) as $line) {
                        $line = trim($line);
                        if (!$line || str_starts_with($line,'#')) continue;
                        $parts = str_getcsv($line);
                        if (count($parts) < 2) continue;
                        $prefix = trim($parts[0]);
                        $rate   = (float)trim($parts[1]);
                        $init   = isset($parts[2]) ? (int)trim($parts[2]) : 60;
                        $inc    = isset($parts[3]) ? (int)trim($parts[3]) : 1;
                        $dest   = isset($parts[4]) ? trim($parts[4]) : '';
                        if (!$dest) {
                            for ($i = strlen($prefix); $i >= 1; $i--) {
                                $d = DB::table('prefix_destinations')->where('prefix', substr($prefix,0,$i))->first();
                                if ($d) { $dest = $d->destination; break; }
                            }
                        }
                        $exists = Rate::where('pricelist_id',$pid)->where('prefix',$prefix)->exists();
                        if ($exists && $data['overwrite']==='skip') { $skipped++; continue; }
                        Rate::updateOrCreate(
                            ['pricelist_id'=>$pid,'prefix'=>$prefix],
                            ['destination'=>$dest,'rate'=>$rate,'initblock'=>$init,'increment'=>$inc,
                             'traffic_type'=>$data['traffic_type'],'status'=>0]
                        );
                        $imported++;
                    }
                    Notification::make()
                        ->title("Imported: {$imported}" . ($skipped ? " | Skipped: {$skipped}" : ''))
                        ->success()->send();
                }),

            DeleteAction::make(),
        ];
    }
}
