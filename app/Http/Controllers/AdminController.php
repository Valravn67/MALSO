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

    public function technician_list()
    {
        $data = DB::table('technician')->get();

        return view('admin.technician_list', compact('data'));
    }
}