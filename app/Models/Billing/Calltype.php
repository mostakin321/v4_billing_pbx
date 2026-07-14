<?php
namespace App\Models\Billing;
class Calltype extends BaseBillingModel {
    protected $table = 'calltype';
    public $timestamps = false;
    protected $fillable = ['call_type','description','status'];
}
