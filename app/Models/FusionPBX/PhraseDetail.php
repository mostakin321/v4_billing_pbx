<?php

namespace App\Models\FusionPBX;


class PhraseDetail extends BaseFusionPbxModel
{
    protected $table = 'v_phrase_details';

    protected $primaryKey = 'phrase_detail_uuid';

    protected $casts = [
        'phrase_detail_group' => 'float',
    ];

}
