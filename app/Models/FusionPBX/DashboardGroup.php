<?php

namespace App\Models\FusionPBX;


class DashboardGroup extends BaseFusionPbxModel
{
    protected $table = 'v_dashboard_widgets';

    protected $primaryKey = 'dashboard_group_uuid';
}
