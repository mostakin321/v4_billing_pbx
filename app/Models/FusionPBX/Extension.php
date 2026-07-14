<?php

namespace App\Models\FusionPBX;

class Extension extends BaseFusionPbxModel
{
    protected $table = 'v_extensions';
    protected $guarded = ['extension_uuid'];
    protected $primaryKey = 'extension_uuid';

    protected $casts = [
        'call_timeout' => 'float',
        'sip_force_expires' => 'float',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->domain_uuid)) {
                $domain = \Illuminate\Support\Facades\DB::connection('fusionpbx')
                    ->table('v_domains')->first();
                if ($domain) {
                    $model->domain_uuid = $domain->domain_uuid;
                    if (empty($model->user_context)) {
                        $model->user_context = $domain->domain_name;
                    }
                }
            }
        });
    }
}
