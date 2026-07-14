<?php

namespace App\Filament\Resources\Astpp\CounterResource\Pages;

use App\Filament\Resources\Astpp\CounterResource\CounterResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCounter extends CreateRecord
{
    protected static string $resource = CounterResource::class;
}
