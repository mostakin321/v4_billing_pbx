<?php

namespace App\Http\Controllers\Api\FusionPBX;

class DashboardGroupController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\DashboardGroup::class;

    protected string $primaryKey = 'dashboard_group_uuid';
}
