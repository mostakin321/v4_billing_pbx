<?php

namespace App\Models\FusionPBX;


class FaxLog extends BaseFusionPbxModel
{
    protected $table = 'v_fax_logs';

    protected $primaryKey = 'fax_log_uuid';

    protected $casts = [
        'fax_bad_rows' => 'float',
        'fax_date' => 'datetime',
        'fax_document_total_pages' => 'float',
        'fax_document_transferred_pages' => 'float',
        'fax_duration' => 'float',
        'fax_epoch' => 'float',
        'fax_image_size' => 'float',
        'fax_result_code' => 'float',
        'fax_retry_attempts' => 'float',
        'fax_retry_limit' => 'float',
        'fax_retry_sleep' => 'float',
        'fax_transfer_rate' => 'float',
    ];

}
