<?php
namespace App\Models\Billing;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Invoice extends BaseBillingModel {
    protected $table = 'invoices';
    public $timestamps = false;
    protected $fillable = ['prefix','number','accountid','reseller_id','from_date','to_date','due_date','status','generate_date','type','notes','is_deleted'];
    protected $casts = ['from_date'=>'datetime','to_date'=>'datetime','due_date'=>'datetime','generate_date'=>'datetime'];
    public function account(): BelongsTo { return $this->belongsTo(Account::class, 'accountid'); }
}
