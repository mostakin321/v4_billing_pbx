<?php

namespace App\Http\Controllers\Api\FusionPBX;

class VoicemailDestinationController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\VoicemailDestination::class;

    protected string $primaryKey = 'voicemail_destination_uuid';
}
