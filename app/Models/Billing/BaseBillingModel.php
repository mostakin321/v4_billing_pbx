<?php
namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Model;

abstract class BaseBillingModel extends Model
{
    protected $connection  = 'mysql';
    public $incrementing   = true;
    protected $keyType     = 'int';
    protected $guarded     = [];
    public $timestamps     = false; // ASTPP tables use creation_date/last_modified_date, not timestamps

    // Override in child models if the table uses these columns
    public const CREATED_AT = 'creation_date';
    public const UPDATED_AT = 'last_modified_date';
}
