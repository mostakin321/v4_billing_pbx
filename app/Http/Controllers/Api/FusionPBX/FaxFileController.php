<?php

namespace App\Http\Controllers\Api\FusionPBX;

class FaxFileController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\FaxFile::class;

    protected string $primaryKey = 'fax_file_uuid';
}
