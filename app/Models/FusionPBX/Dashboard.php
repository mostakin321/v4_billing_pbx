<?php

namespace App\Models\FusionPBX;


class Dashboard extends BaseFusionPbxModel
{
    protected $table = 'v_dashboards';

    protected $primaryKey = 'dashboard_uuid';

    protected $casts = [
        'dashboard_column_span' => 'float',
        'dashboard_enabled' => 'boolean',
        'dashboard_height' => 'float',
        'dashboard_label_enabled' => 'boolean',
        'dashboard_order' => 'float',
        'dashboard_row_span' => 'float',
        'dashboard_width' => 'float',
    ];

}
