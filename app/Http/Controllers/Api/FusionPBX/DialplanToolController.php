<?php

namespace App\Http\Controllers\Api\FusionPBX;

class DialplanToolController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\DialplanTool::class;

    protected string $primaryKey = 'dialplan_tool_uuid';
}
