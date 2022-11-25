<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

date_default_timezone_set("Asia/Makassar");

class LogisticsController extends Controller
{
    public function stock_material()
    {
        $get_warehouse = DB::table('warehouse')->select('id_warehouse as id', 'warehouse_name as text')->get();
        
        return view('logistics.stock_material', compact('get_warehouse'));
    }
    public function save_stock_material(Request $req)
    {
        dd($req->all());
    }
    public function out_material()
    {
        return view('logistics.out_material');
    }
}