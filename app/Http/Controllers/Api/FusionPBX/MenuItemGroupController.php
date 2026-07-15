<?php

namespace App\Http\Controllers\Api\FusionPBX;

class MenuItemGroupController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\MenuItemGroup::class;

    protected string $primaryKey = 'menu_item_group_uuid';
}
