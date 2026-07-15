<?php

namespace App\Http\Controllers\Api\FusionPBX;

class MenuItemController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\MenuItem::class;

    protected string $primaryKey = 'menu_item_uuid';
}
