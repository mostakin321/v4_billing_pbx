<?php

namespace App\Models\FusionPBX;


class FaxFile extends BaseFusionPbxModel
{
    protected $table = 'v_fax_files';

    protected $primaryKey = 'fax_file_uuid';

    protected $casts = [
        'fax_date' => 'datetime',
        'fax_epoch' => 'float',
        'read_date' => 'datetime',
    ];

}
