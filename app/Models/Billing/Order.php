<?php
namespace App\Models\Billing;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Order extends BaseBillingModel {
    protected $table = 'orders';
    public $timestamps = false;
    protected $fillable = ['order_id','parent_order_id','order_date','order_generated_by','payment_gateway','payment_status','accountid','reseller_id','ip'];
    protected $casts = ['order_date'=>'datetime'];
    public function account(): BelongsTo { return $this->belongsTo(Account::class, 'accountid'); }
    public function reseller(): BelongsTo { return $this->belongsTo(Account::class, 'reseller_id'); }
}
