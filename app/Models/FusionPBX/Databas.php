<?php

namespace App\Models\FusionPBX;


class Databas extends BaseFusionPbxModel
{
    protected $table = 'v_databases';

    protected $primaryKey = 'database_uuid';
}
