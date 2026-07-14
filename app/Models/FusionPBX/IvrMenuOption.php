<?php

namespace App\Models\FusionPBX;

class IvrMenuOption extends BaseFusionPbxModel
{
    protected $table = 'v_ivr_menu_options';
    protected $primaryKey = 'ivr_menu_option_uuid';

    protected $casts = [
        'ivr_menu_option_order' => 'float',
    ];
}
