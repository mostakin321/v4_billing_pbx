<?php
namespace App\Filament\Resources\Astpp\PricelistResource\Pages;
use App\Filament\Resources\Astpp\PricelistResource\PricelistResource;
use App\Models\Astpp\Rate;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

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
                            TextInput::make('pattern')->label('Prefix')->required()->placeholder('880'),
                            TextInput::make('comment')->label('Destination')->placeholder('Bangladesh'),
                            TextInput::make('cost')->label('Rate/Min $')->numeric()->required()->default(0),
                            TextInput::make('connectcost')->label('Connect $')->numeric()->default(0),
                            TextInput::make('init_inc')->label('Init(s)')->numeric()->default(60),
                            TextInput::make('inc')->label('Inc(s)')->numeric()->default(1),
                            TextInput::make('precedence')->label('Priority')->numeric()->default(0),
                            Select::make('status')->options([0=>'Active',1=>'Inactive'])->default(0),
                        ])
                        ->columns(4)
                        ->addActionLabel('+ Add Prefix')
                        ->default(fn() => Rate::where('pricelist_id', $this->record->id)->get()
                            ->map(fn($r) => [
                                'pattern'     => $r->pattern,
                                'comment'     => $r->comment,
                                'cost'        => $r->cost,
                                'connectcost' => $r->connectcost,
                                'init_inc'    => $r->init_inc,
                                'inc'         => $r->inc,
                                'precedence'  => $r->precedence,
                                'status'      => $r->status,
                            ])->toArray()),
                ])
                ->action(function (array $data): void {
                    $pid = $this->record->id;
                    $patterns = collect($data['rates'])->pluck('pattern')->toArray();
                    Rate::where('pricelist_id', $pid)->whereNotIn('pattern', $patterns)->delete();
                    foreach ($data['rates'] as $row) {
                        Rate::updateOrCreate(
                            ['pricelist_id' => $pid, 'pattern' => $row['pattern']],
                            [
                                'comment'     => $row['comment'] ?? '',
                                'cost'        => $row['cost'],
                                'connectcost' => $row['connectcost'] ?? 0,
                                'init_inc'    => $row['init_inc'] ?? 60,
                                'inc'         => $row['inc'] ?? 1,
                                'precedence'  => $row['precedence'] ?? 0,
                                'status'      => $row['status'] ?? 0,
                                'reseller_id' => 0,
                                'accountid'   => 0,
                                'call_count'  => 0,
                            ]
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
                        ->label('Paste CSV: prefix,rate,destination,init_inc,inc')
                        ->placeholder("880,0.015,Bangladesh,60,6\n8801,0.025,Bangladesh Mobile,60,1")
                        ->rows(10)->required(),
                    Select::make('overwrite')
                        ->options(['update'=>'Update existing','skip'=>'Skip existing'])
                        ->default('update'),
                ])
                ->action(function (array $data): void {
                    $pid = $this->record->id;
                    $imported = $skipped = 0;
                    foreach (explode("\n", trim($data['csv_data'])) as $line) {
                        $line = trim($line);
                        if (!$line || str_starts_with($line,'#')) continue;
                        $parts = str_getcsv($line);
                        if (count($parts) < 2) continue;
                        $pattern = trim($parts[0]);
                        $cost    = (float)trim($parts[1]);
                        $dest    = isset($parts[2]) ? trim($parts[2]) : '';
                        $init    = isset($parts[3]) ? (int)trim($parts[3]) : 60;
                        $inc     = isset($parts[4]) ? (int)trim($parts[4]) : 1;
                        $exists  = Rate::where('pricelist_id',$pid)->where('pattern',$pattern)->exists();
                        if ($exists && $data['overwrite']==='skip') { $skipped++; continue; }
                        Rate::updateOrCreate(
                            ['pricelist_id'=>$pid,'pattern'=>$pattern],
                            ['comment'=>$dest,'cost'=>$cost,'init_inc'=>$init,'inc'=>$inc,
                             'status'=>0,'reseller_id'=>0,'accountid'=>0,'call_count'=>0]
                        );
                        $imported++;
                    }
                    Notification::make()
                        ->title("Imported: {$imported}".($skipped ? " | Skipped: {$skipped}" : ''))
                        ->success()->send();
                }),

            DeleteAction::make(),
        ];
    }
}
