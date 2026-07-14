<?php

namespace App\Models\FusionPBX;


class AccessControlNode extends BaseFusionPbxModel
{
    protected $table = 'v_access_control_nodes';

    protected $primaryKey = 'access_control_node_uuid';
}
