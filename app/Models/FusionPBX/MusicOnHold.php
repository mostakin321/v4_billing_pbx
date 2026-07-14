<?php

namespace App\Models\FusionPBX;


class MusicOnHold extends BaseFusionPbxModel
{
    protected $table = 'v_music_on_hold';

    protected $primaryKey = 'music_on_hold_uuid';

    protected $casts = [
        'music_on_hold_channels' => 'float',
        'music_on_hold_chime_freq' => 'float',
        'music_on_hold_chime_max' => 'float',
        'music_on_hold_interval' => 'float',
        'music_on_hold_rate' => 'float',
    ];

}
