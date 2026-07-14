<?php

namespace App\Models\FusionPBX;


class CallCenterAgent extends BaseFusionPbxModel
{
    protected $table = 'v_call_center_agents';

    protected $primaryKey = 'call_center_agent_uuid';

    protected $casts = [
        'agent_busy_delay_time' => 'float',
        'agent_call_timeout' => 'float',
        'agent_max_no_answer' => 'float',
        'agent_reject_delay_time' => 'float',
        'agent_wrap_up_time' => 'float',
    ];

}
