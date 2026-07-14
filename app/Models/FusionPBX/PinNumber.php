<?php

namespace App\Models\FusionPBX;


class PinNumber extends BaseFusionPbxModel
{
    protected $table = 'v_pin_numbers';

    protected $primaryKey = 'pin_number_uuid';
}
