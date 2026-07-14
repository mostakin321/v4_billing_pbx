<?php

namespace App\Models\FusionPBX;


class DialplanTool extends BaseFusionPbxModel
{
    protected $table = 'v_dialplan_tools';

    protected $primaryKey = 'dialplan_tool_uuid';

    protected $casts = [
        'enabled' => 'boolean',
    ];

}
