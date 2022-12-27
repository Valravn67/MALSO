<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Imports\LogisticsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Model\LogisticsModel;

date_default_timezone_set("Asia/Makassar");

class LogisticsController extends Controller
{
    public function stock_material()
    {
        $get_warehouse = DB::table('gudang')->select('id_warehouse as id', 'warehouse_name as text')->orderBy('id_warehouse', 'ASC')->get();
        
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
        $get_warehouse = DB::table('gudang')->select('id_warehouse as id', 'warehouse_name as text')->get();
        $get_technician = DB::table('technician')->get();

        return view('logistics.out_material', compact('get_warehouse', 'get_technician'));
    }
    
    public function save_out_material(request $req)
	{
        foreach ($req->id_mats as $id_mats => $qty)
        {
            if (!in_array($qty, [0, NULL]))
            {
                DB::table('out_materials')->insert([
                    'id_warehouse' => $req->id_warehouse,
                    'id_technician' => $req->id_technician,
                    'id_mats' => $id_mats,
                    'qty' => $qty,
                    'note' => $req->note
                ]);
            }
        }

        return back()->with('alerts', [
            [
                'type' => 'success',
                'text' => 'Data telah ditambahkan!'
            ]
        ]);
	}

    public function call_out_material(Request $req)
    {
        return \Response::json(LogisticsModel::call_out_material($req->id));
    }

    public function report_stock_material()
    {
        $data = LogisticsModel::report_stock_material();

        return view('report.stock_material', compact('data'));
    
    }

    public function report_out_material()
    {
        $id = Input::get('id_warehouse');

        $get_warehouse = DB::table('gudang')->select('id_warehouse as id', 'warehouse_name as text')->orderBy('id_warehouse', 'ASC')->get();

        $data = LogisticsModel::report_out_material($id);

        return view('report.out_material', compact('id', 'get_warehouse', 'data'));
   
    }

	public function detail_material()
	{
        $id_warehouse = input::get('id_warehouse');
        $id_mats = input::get('id_mats');

        $data = LogisticsModel::detail_material($id_warehouse, $id_mats);
        dd($data);

        return view('report.detail_material', compact('data'));    
	}

}

