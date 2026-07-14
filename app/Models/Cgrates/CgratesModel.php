<?php
namespace App\Models\Cgrates;
use Illuminate\Database\Eloquent\Model;
class CgratesModel extends Model
{
    protected $connection = 'cgrates';
    public $timestamps = false;
}
