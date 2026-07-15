<?php

namespace App\Http\Controllers\Api\FusionPBX;

class IvrMenuController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\IvrMenu::class;

    protected string $primaryKey = 'ivr_menu_uuid';
}
