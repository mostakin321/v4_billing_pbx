<?php

namespace App\Models\Cgrates;

class TpAccountAction extends CgratesModel
{
    protected $table = 'tp_account_actions';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'tpid',
        'loadid',
        'tenant',
        'account',
        'action_plan_tag',
        'action_triggers_tag',
        'allow_negative',
        'disabled',
        'created_at',
    ];

    protected $casts = [
        'allow_negative' => 'boolean',
        'disabled' => 'boolean',
        'created_at' => 'datetime',
    ];

    public function isDisabled(): bool
    {
        return (bool) $this->disabled;
    }
}
