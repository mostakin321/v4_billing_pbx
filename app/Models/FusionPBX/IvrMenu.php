<?php

namespace App\Models\FusionPBX;

use Illuminate\Database\Eloquent\Relations\HasMany;

class IvrMenu extends BaseFusionPbxModel
{
    protected $table = 'v_ivr_menus';
    protected $primaryKey = 'ivr_menu_uuid';

    protected $casts = [
        'ivr_menu_confirm_attempts'   => 'float',
        'ivr_menu_digit_len'          => 'float',
        'ivr_menu_inter_digit_timeout'=> 'float',
        'ivr_menu_max_failures'       => 'float',
        'ivr_menu_max_timeouts'       => 'float',
        'ivr_menu_timeout'            => 'float',
    ];

    public function options(): HasMany
    {
        return $this->hasMany(IvrMenuOption::class, 'ivr_menu_uuid', 'ivr_menu_uuid')
                    ->orderBy('ivr_menu_option_order');
    }
}
