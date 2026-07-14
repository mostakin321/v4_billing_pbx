<?php

namespace App\Models\FusionPBX;


class XmlCdrJson extends BaseFusionPbxModel
{
    protected $table = 'v_xml_cdr_json';

    protected $primaryKey = 'xml_cdr_json_uuid';

    protected $casts = [
        'start_stamp' => 'datetime',
    ];

}
