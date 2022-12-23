<?php
 
namespace App\Model;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

date_default_timezone_set("Asia/Makassar");
 
class LogisticsModel extends Model
{
    protected $table = "stock_materials";
 
    protected $fillable = ['warehouse_id', 'note', 'designator', 'designator_type', 'unit', 'qty'];

    public static function call_out_material($id)
    {
        return DB::table('stock_materials')->where('warehouse_id', $id)->get();
    }

    public static function report_stock_material()
    {
        return DB::table('gudang')
            ->join('stock_materials', 'gudang.id_warehouse', '=', 'stock_materials.warehouse_id')
            ->groupBy('gudang.warehouse_name', 'stock_materials.designator_type')
            ->orderBy('stock_materials.designator_type', 'ASC')
            ->get();
    }

    public static function report_out_material($id)
    {
        return DB::table('out_materials AS om')
        ->join('gudang AS g', 'om.id_warehouse', '=', 'g.id_warehouse')
        ->join('technician AS t', 'om.id_technician', '=', 't.id_technician')
        ->join('stock_materials AS sm', 'om.id_mats', '=', 'sm.id')
        ->select('g.warehouse_name', 'sm.designator_type', 'sm.designator', 'om.qty AS terpakai', 'sm.qty AS sisa')
        ->where('g.id_warehouse', $id)
        ->groupBy('sm.designator_type')
        ->get();
    }

    public static function detail_material()
    {
        return DB::table('out_materials AS om')
        ->join('technician as t', 'om.id_technician', '=', 't.id_technician')
        ->select('t.nik','t.name','om.qty')
        ->groupBy('t.name','om.qty')
        ->get();
    }

}
