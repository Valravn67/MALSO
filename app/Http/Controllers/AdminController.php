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

    public function save_staff(request $req)
	{
        // dd ($req->all());
        DB::table('gudang')->insert([
            'id_warehouse' => $req->id_warehouse,
            'warehouse_name' => $req->warehouse_name,
            'nik_staff_1' => $req->nik_staff_1,
            'name_staff_1'=> $req->name_staff_1,
            'nik_staff_2'=> $req->nik_staff_2,
            'name_staff_2'=> $req->name_staff_2
        ]);
        return back()->with('alerts', [
            [
                'type' => 'success',
                'text' => 'Data staff telah ditambahkan!'
            ]
        ]);
	}

    public function get_warehouse_staff(request $req)
	{
        $data = DB::table('gudang')->where('id_warehouse', $req->id)->first();

       return \Response::json($data);
	}

    public function update_warehouse_staff(request $req)
	{
        // dd($req->all());
        DB::table('gudang')->where('id_warehouse', $req->id)->update([
            'id_warehouse' => $req->id_warehouse,
            'warehouse_name' => $req->warehouse_name,
            'nik_staff_1' => $req->nik_staff_1,
            'name_staff_1'=> $req->name_staff_1,
            'nik_staff_2'=> $req->nik_staff_2,
            'name_staff_2'=> $req->name_staff_2
        ]);
        
        return back()->with('alerts', [
            [
                'type' => 'success',
                'text' => 'Data staff telah ditambahkan!'
            ]
        ]);
	}

    public function technician_list()
    {
        $data = DB::table('technician')->get();

        return view('admin.technician_list', compact('data'));
    }

	public function save_technician(request $req)
	{

		DB::table('technician')->insert([
            'nik' => $req->nik,
            'name' => $req->name
        ]);

        return back()->with('alerts', [
            [
                'type' => 'success',
                'text' => 'Data teknisi telah ditambahkan!'
            ]
        ]);
	}

	public function get_teknisi(request $req)
	{
        $data = DB::table('technician')->where('id_technician', $req->id)->first();

       return \Response::json($data);
	}

	public function update_teknisi(request $req)
	{
		// dd($req->all());
        DB::table('technician')->where('id_technician', $req->id)->update([
            'nik' => $req->nik,
            'name' => $req->name
        ]);
        return back()->with('alerts', [
            [
                'type' => 'success',
                'text' => 'Data teknisi telah ditambahkan!'
            ]
        ]);
	}




}