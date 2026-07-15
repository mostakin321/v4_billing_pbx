<?php

namespace App\Http\Controllers\Api\FusionPBX;

class AccessControlNodeController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\AccessControlNode::class;

    protected string $primaryKey = 'access_control_node_uuid';
}
