<?php

namespace App\Models\FusionPBX;


class MenuItem extends BaseFusionPbxModel
{
    protected $table = 'v_menu_items';

    protected $primaryKey = 'menu_item_uuid';

    protected $casts = [
        'menu_item_order' => 'float',
    ];

}
