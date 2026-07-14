<?php

namespace App\Models\FusionPBX;


class XmlCdrFlow extends BaseFusionPbxModel
{
    protected $table = 'v_xml_cdr_flow';

    protected $primaryKey = 'xml_cdr_flow_uuid';

    protected $casts = [
        'call_flow' => 'array',
    ];

}
