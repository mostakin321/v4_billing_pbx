<?php

namespace App\Http\Controllers\Api\FusionPBX;

class DashboardController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\Dashboard::class;

    protected string $primaryKey = 'dashboard_uuid';
}
