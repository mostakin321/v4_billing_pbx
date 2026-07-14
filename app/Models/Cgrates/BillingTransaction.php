<?php
namespace App\Models\Cgrates;
class BillingTransaction extends CgratesModel
{
    protected $table    = 'billing_transactions';
    public $timestamps  = true;
    protected $fillable = ['account_id','type','amount','balance_after','description','reference_id'];
}
