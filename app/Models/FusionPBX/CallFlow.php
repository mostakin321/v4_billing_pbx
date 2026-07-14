<?php

namespace App\Models\FusionPBX;


class CallFlow extends BaseFusionPbxModel
{
    protected $table = 'v_call_flows';

    protected $primaryKey = 'call_flow_uuid';
}
