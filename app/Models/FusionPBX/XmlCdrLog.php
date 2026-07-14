<?php

namespace App\Models\FusionPBX;


class XmlCdrLog extends BaseFusionPbxModel
{
    protected $table = 'v_xml_cdr_logs';

    protected $primaryKey = 'xml_cdr_log_uuid';
}
