<?php

namespace App\Models\Cgrates;

class TpRoute extends CgratesModel
{
    protected $table = 'tp_routes';
    protected $primaryKey = 'pk';
    public $timestamps = false;

    protected $fillable = [
        'pk', 'tpid', 'tenant', 'id', 'filter_ids',
        'activation_interval', 'sorting', 'sorting_parameters', 'route_id',
        'route_filter_ids', 'route_account_ids', 'route_ratingplan_ids',
        'route_rate_profile_ids', 'route_resource_ids', 'route_stat_ids',
        'route_weight', 'route_blocker', 'route_parameters', 'weight', 'created_at',
    ];

    protected $casts = [
        'route_weight' => 'decimal:2',
        'route_blocker' => 'boolean',
        'weight' => 'decimal:2',
        'created_at' => 'datetime',
    ];

    public function filterIdList(): array
    {
        return $this->csvToArray($this->filter_ids);
    }

    public function accountIdList(): array
    {
        return $this->csvToArray($this->account_ids);
    }

    public function ratingPlanIdList(): array
    {
        return $this->csvToArray($this->rating_plan_ids);
    }
}
