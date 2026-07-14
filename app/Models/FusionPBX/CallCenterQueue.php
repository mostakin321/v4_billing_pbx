<?php

namespace App\Models\FusionPBX;


class CallCenterQueue extends BaseFusionPbxModel
{
    protected $table = 'v_call_center_queues';

    protected $primaryKey = 'call_center_queue_uuid';

    protected $casts = [
        'queue_announce_frequency' => 'float',
        'queue_discard_abandoned_after' => 'float',
        'queue_max_wait_time' => 'float',
        'queue_max_wait_time_with_no_agent' => 'float',
        'queue_max_wait_time_with_no_agent_time_reached' => 'float',
        'queue_tier_rule_wait_second' => 'float',
        'queue_time_base_score_sec' => 'float',
    ];

}
