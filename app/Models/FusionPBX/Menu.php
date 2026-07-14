<?php

namespace App\Models\FusionPBX;


class Menu extends BaseFusionPbxModel
{
    protected $table = 'v_menus';

    protected $primaryKey = 'menu_uuid';
}
