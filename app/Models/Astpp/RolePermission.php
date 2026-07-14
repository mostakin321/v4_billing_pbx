<?php

namespace App\Models\Astpp;

class RolePermission extends BaseAstppModel
{
    protected $table = 'roles_and_permission';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'login_type' => 'integer',
        'permission_type' => 'integer',
        'status' => 'integer',
        'creation_date' => 'datetime',
        'priority' => 'decimal:6',
    ];

}
