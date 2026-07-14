<?php

namespace App\Models\FusionPBX;


class XmlCdr extends BaseFusionPbxModel
{
    protected $table = 'v_xml_cdr';

    protected $primaryKey = 'xml_cdr_uuid';

    protected $casts = [
        'answer_epoch' => 'float',
        'answer_stamp' => 'datetime',
        'billmsec' => 'float',
        'billsec' => 'float',
        'call_flow' => 'array',
        'cc_queue_answered_epoch' => 'float',
        'cc_queue_canceled_epoch' => 'float',
        'cc_queue_joined_epoch' => 'float',
        'cc_queue_terminated_epoch' => 'float',
        'duration' => 'float',
        'end_epoch' => 'float',
        'end_stamp' => 'datetime',
        'hangup_cause_q850' => 'float',
        'hold_accum_seconds' => 'float',
        'mduration' => 'float',
        'missed_call' => 'boolean',
        'pdd_ms' => 'float',
        'record_length' => 'float',
        'rtp_audio_in_mos' => 'float',
        'start_epoch' => 'float',
        'start_stamp' => 'datetime',
        'voicemail_message' => 'boolean',
        'waitsec' => 'float',
    ];

}
