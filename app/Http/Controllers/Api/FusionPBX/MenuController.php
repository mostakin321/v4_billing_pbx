<?php

namespace App\Http\Controllers\Api\FusionPBX;

class MenuController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\Menu::class;

    protected string $primaryKey = 'menu_uuid';
}
