<?php
 
namespace App\Model;
 
use Illuminate\Database\Eloquent\Model;
 
class LogisticsModel extends Model
{
    protected $table = "stock_materials";
 
    protected $fillable = ['warehouse_id', 'note', 'designator', 'designator_type', 'unit', 'qty'];
}