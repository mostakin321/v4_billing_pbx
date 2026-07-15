<?php

namespace App\Http\Controllers\Api\FusionPBX;

class SipProfileDomainController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\SipProfileDomain::class;

    protected string $primaryKey = 'sip_profile_domain_uuid';
}
