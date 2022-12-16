<?php
 
namespace App\Model;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

date_default_timezone_set("Asia/Makassar");
 
class LogisticsModel extends Model
{
    protected $table = "stock_materials";
 
    protected $fillable = ['warehouse_id', 'note', 'designator', 'designator_type', 'unit', 'qty'];

    public static function report_stock_material()
    {
        return DB::table('gudang')
            ->join('stock_materials', 'gudang.id_warehouse', '=', 'stock_materials.warehouse_id')
            ->groupBy('gudang.warehouse_name', 'stock_materials.designator_type')
            ->orderBy('stock_materials.designator_type', 'ASC')
            ->get();
    }

    public static function report_out_material()
    {
        return DB::table('gudang')
            ->join('stock_materials', 'gudang.id_warehouse', '=', 'stock_materials.warehouse_id')
            ->join('technician', 'gudang.id_warehouse', '=', 'technician.id_technician')
            ->groupBy('gudang.warehouse_name', 'stock_materials.designator_type')
            ->orderBy('stock_materials.designator_type', 'ASC')
            ->get();
    }

    public static function call_out_material($id)
    {
        return DB::table('stock_materials')->get();
        // return DB::table('stock_materials')->where('warehouse_id', $id)->get();
    }
}