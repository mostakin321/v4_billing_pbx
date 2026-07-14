<?php

namespace App\Services\Cgrates\Reports;

use App\Models\Cgrates\Cdr;

class CdrIngestService
{
    public function store(array $attributes): Cdr
    {
        return Cdr::updateOrCreate(
            ['cgrid' => $attributes['cgrid'], 'run_id' => $attributes['run_id']],
            $attributes
        );
    }
}
