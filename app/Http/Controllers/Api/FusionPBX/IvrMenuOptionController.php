<?php

namespace App\Http\Controllers\Api\FusionPBX;

class IvrMenuOptionController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\IvrMenuOption::class;

    protected string $primaryKey = 'ivr_menu_option_uuid';
}
