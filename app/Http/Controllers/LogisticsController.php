<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\LogisticsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

date_default_timezone_set("Asia/Makassar");

class LogisticsController extends Controller
{
    public function stock_material()
    {
        $get_warehouse = DB::table('gudang')->select('id_warehouse as id', 'warehouse_name as text')->get();
        
        return view('logistics.stock_material', compact('get_warehouse'));
    }

    public function save_stock_material(Request $req)
    {
		$file = $req->file('upload_stock');
		$nama_file = rand().$file->getClientOriginalName();
		$file->move('stock_warehouse',$nama_file);
		Excel::import(new LogisticsImport($req), public_path('/stock_warehouse/'.$nama_file));
 
        return redirect('/logistics/stock_material')->with('alerts', [
            [
                'type' => 'success',
                'text' => 'Data Stok Berhasil Diimport!'
            ]
        ]);
    }

    public function out_material()
    {
        return view('logistics.out_material');
    }

    public function report_stock_material()
    {
        return view('logistics.report_stock_material');
    }

    public function report_out_material()
    {
        return view('logistics.report_out_material');
    }
}