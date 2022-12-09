<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

date_default_timezone_set("Asia/Makassar");

class AdminController extends Controller
{
    public function warehouse_staff_list()
    {
        $data = DB::table('gudang')->get();

        return view('admin.warehouse_staff_list', compact('data'));
    }

    public function get_warehouse_staff(request $req)
	{
        $data = DB::table('gudang')->where('id_warehouse', $req->id)->first();

       return \Response::json($data);
	}

    public function save_staff(request $req)
	{
        switch ($req->is_save) {
            case 'insert':
                $check = DB::table('gudang')->where('warehouse_name', $req->warehouse_name)->first();

                if (!empty($check))
                {
                    DB::table('gudang')->where('id_warehouse', $check->id_warehouse)->update([
                        'warehouse_name' => $req->warehouse_name,
                        'nik_staff_1' => $req->nik_staff_1,
                        'name_staff_1'=> $req->name_staff_1,
                        'nik_staff_2'=> $req->nik_staff_2,
                        'name_staff_2'=> $req->name_staff_2
                    ]);

                    $text = 'Data Staff Berhasil Diperbaharui!';
                } else {
                    DB::table('gudang')->insert([
                        'warehouse_name' => $req->warehouse_name,
                        'nik_staff_1' => $req->nik_staff_1,
                        'name_staff_1'=> $req->name_staff_1,
                        'nik_staff_2'=> $req->nik_staff_2,
                        'name_staff_2'=> $req->name_staff_2
                    ]);

                    $text = 'Data Staff Berhasil Ditambahkan!';
                }
                break;
            
            case 'update':
                DB::table('gudang')->where('id_warehouse', $req->id)->update([
                    'warehouse_name' => $req->warehouse_name,
                    'nik_staff_1' => $req->nik_staff_1,
                    'name_staff_1'=> $req->name_staff_1,
                    'nik_staff_2'=> $req->nik_staff_2,
                    'name_staff_2'=> $req->name_staff_2
                ]);

                $text = 'Data Staff Berhasil Diperbaharui!';
                break;
        }
        
        return back()->with('alerts', [
            [
                'type' => 'success',
                'text' => $text
            ]
        ]);
	}

    public function technician_list()
    {
        $data = DB::table('technician')->get();

        return view('admin.technician_list', compact('data'));
    }

    public function get_teknisi(request $req)
	{
        $data = DB::table('technician')->where('id_technician', $req->id)->first();

       return \Response::json($data);
	}

	public function save_technician(request $req)
	{
        switch ($req->is_save) {
            case 'insert':
                $check = DB::table('technician')->where('nik', $req->nik)->first();

                if (!empty($check))
                {
                    DB::table('technician')->where('id_technician', $req->id)->update([
                        'nik' => $req->nik,
                        'name' => $req->name
                    ]);

                    $text = 'Data Teknisi Berhasil Diperbaharui!';
                } else {
                    DB::table('technician')->insert([
                        'nik' => $req->nik,
                        'name' => $req->name
                    ]);

                    $text = 'Data Teknisi Berhasil Ditambahkan!';
                }
                break;
            
            case 'update':
                DB::table('technician')->where('id_technician', $req->id)->update([
                    'nik' => $req->nik,
                    'name' => $req->name
                ]);

                $text = 'Data Teknisi Berhasil Diperbaharui!';
                break;
        }

        return back()->with('alerts', [
            [
                'type' => 'success',
                'text' => $text
            ]
        ]);
	}
}