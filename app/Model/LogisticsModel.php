<?php
 
namespace App\Model;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
date_default_timezone_set("Asia/Makassar");
 
class LogisticsModel extends Model
{
        
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
        ->join('stock_materials AS sm', 'om.id_mats', '=', 'sm.id')
        ->select('g.warehouse_name', 'sm.id AS id_designator', 'sm.designator_type', 'sm.designator', DB::Raw("sum(om.qty) AS terpakai"), 'sm.qty AS sisa')
        ->where('g.id_warehouse', $id)
        ->groupBy('sm.id')
        ->get();

    }

    public static function detail_material($id_warehouse, $id_mats)
    {
        return DB::table('out_materials AS om')
        ->join('gudang AS g', 'om.id_warehouse', '=', 'g.id_warehouse')
        ->join('technician AS t', 'om.id_technician', '=', 't.id_technician')
        ->join('stock_materials AS sm', 'om.id_mats', '=', 'sm.id')
        ->select('g.warehouse_name' , 'sm.designator_type', 'sm.designator', 'om.qty', 't.nik', 't.name')
        ->where('om.id_warehouse', $id_warehouse)
        ->where('om.id_mats', $id_mats)
        ->get();
    }

    public static function dashboard_material($view, $type)
    {
        switch ($view) {
            case 'stock_materials':
                switch ($type) {
                    case 'day':
                        $days = '';
                        for ($i = 1; $i < date('t') + 1; $i ++)
                        {
                            if ($i < 10)
                            {
                                $keys = '0'.$i;
                            } else {
                                $keys = $i;
                            }
                            $days .= ',SUM(CASE WHEN (DATE(sm.updated_at) = "'.date('Y-m-').''.$keys.'") THEN 1 ELSE 0 END) as sm_day'.$keys.'';
                        }
                        return DB::select('
                            SELECT
                            g.warehouse_name
                            '.$days.'
                            FROM stock_materials sm
                            LEFT JOIN gudang g ON sm.warehouse_id = g.id_warehouse
                            GROUP BY g.warehouse_name
                        ');
                        break;
                    case 'month':
                        $months = ['januari' => '01', 'februari' => '02', 'maret' => '03', 'april' => '04', 'mei' => '05', 'juni' => '06', 'juli' => '07', 'agustus' => '08', 'september' => '09', 'oktober' => '10', 'november' => '11', 'desember' => '12'];
                        $sums = '';
                        foreach ($months as $key => $value)
                        {
                            $keys = date('Y-').$value;
                            $sums .= ',SUM(CASE WHEN (DATE(sm.updated_at) LIKE "'.$keys.'%") THEN 1 ELSE 0 END) as '.$key;
                        }
                        return DB::select('
                            SELECT
                            g.warehouse_name
                            '.$sums.'
                            FROM stock_materials sm
                            LEFT JOIN gudang g ON sm.warehouse_id = g.id_warehouse
                            GROUP BY g.warehouse_name
                        ');
                        break;
                }
                break;
            case 'out_materials':
                switch ($type) {
                    case 'day':
                        
                        break;
                    case 'month':
                        $days = '';
                        for ($i = 1; $i < date('t') + 1; $i ++)
                        {
                            if ($i < 10)
                            {
                                $keys = '0'.$i;
                            } else {
                                $keys = $i;
                            }
                            $days .= ',SUM(CASE WHEN (DATE(sm.updated_at) = "'.date('Y-m-').''.$keys.'") THEN 1 ELSE 0 END) as sm_day'.$keys.'';
                        }
                        return DB::select('
                            SELECT
                            g.warehouse_name
                            '.$days.'
                            FROM stock_materials sm
                            LEFT JOIN gudang g ON sm.warehouse_id = g.id_warehouse
                            GROUP BY g.warehouse_name
                        ');
                        break;
                }
                break;
        }
    }

}
