<?php

namespace App\Models\FusionPBX;


class XmlCdrExtension extends BaseFusionPbxModel
{
    protected $table = 'v_xml_cdr_extensions';

    protected $primaryKey = 'xml_cdr_extension_uuid';

    protected $casts = [
        'duration' => 'float',
        'end_stamp' => 'datetime',
        'start_stamp' => 'datetime',
    ];

}
