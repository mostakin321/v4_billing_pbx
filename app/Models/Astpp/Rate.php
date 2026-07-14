<?php
namespace App\Models\Astpp;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model {
    protected $connection = 'astpp';
    protected $table = 'routes';
    public $timestamps = false;
    protected $fillable = [
        'pattern','comment','connectcost','includedseconds',
        'cost','pricelist_id','inc','country_id','call_type',
        'routing_type','percentage','call_count',
        'accountid','reseller_id','precedence','status',
        'trunk_id','init_inc','creation_date','last_modified_date',
    ];
    protected $casts = [
        'cost'        => 'decimal:5',
        'connectcost' => 'decimal:5',
    ];
}
