<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
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
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
		$reader->setReadDataOnly(true);
		$spreadSheet = $reader->load($req->file('upload_stock'));
		$sheet = $spreadSheet->getSheet($spreadSheet->getFirstSheetIndex());
		$data = $sheet->toArray();
		unset($data[0]);
            
        foreach ($data as $key => $value)
		{  
            $check = DB::table('stock_materials')
            ->where('designator_type', $value[1])
            ->where('warehouse_id', $req->warehouse_id)
            ->first();
            if($check){
                DB::table('stock_materials')
                ->where('warehouse_id', $req->warehouse_id)
                ->where('designator_type', $value[1])
                ->update([
                    'warehouse_id' => $req->warehouse_id,
                    'note' => $req->note,
                    'designator' => $value[0],
                    'designator_type' => $value[1],
                    'unit' => $value[2],
                    'qty' => ($check->qty + $value[3]),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
            else{
            DB::table('stock_materials')
                ->insert([
                    'warehouse_id' => $req->warehouse_id,
                    'note' => $req->note,
                    'designator' => $value[0],
                    'designator_type' => $value[1],
                    'unit' => $value[2],
                    'qty' => $value[3],
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }
        }
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
                    'note' => $req->note,
                    'created_at' => date('Y-m-d H:i:s')
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

        return view('report.detail_material', compact('data'));    
	}

}

