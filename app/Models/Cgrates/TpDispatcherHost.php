<?php

namespace App\Models\Cgrates;

class TpDispatcherHost extends CgratesModel
{
    protected $table = 'tp_dispatcher_hosts';
    protected $primaryKey = 'pk';
    public $timestamps = false;

    protected $fillable = [
        'pk', 'tpid', 'tenant', 'id', 'address', 'transport',
        'connect_attempts', 'reconnects', 'max_reconnect_interval',
        'connect_timeout', 'reply_timeout', 'tls', 'client_key',
        'client_certificate', 'ca_certificate', 'created_at',
    ];

    protected $casts = [
        'tls' => 'boolean',
        'created_at' => 'datetime',
    ];
}
