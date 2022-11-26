<?php
 
namespace App\Model;
 
use Illuminate\Database\Eloquent\Model;

date_default_timezone_set("Asia/Makassar");
 
class LogisticsModel extends Model
{
    protected $table = "stock_materials";
 
    protected $fillable = ['warehouse_id', 'note', 'designator', 'designator_type', 'unit', 'qty'];
}