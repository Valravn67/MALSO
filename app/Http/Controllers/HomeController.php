<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Model\LogisticsModel;

date_default_timezone_set("Asia/Makassar");

class HomeController extends Controller
{
    public function home()
    {
        $rekap_harian_sm = LogisticsModel::dashboard_material('stock_materials', 'day');
        $rekap_bulanan_sm = LogisticsModel::dashboard_material('stock_materials', 'month');
        // dd($rekap_harian_sm, $rekap_bulanan_sm);

        $rekap_harian_om = LogisticsModel::dashboard_material('out_materials', 'day');
        $rekap_bulanan_om = LogisticsModel::dashboard_material('out_materials', 'month');
        
        return view('home', compact('rekap_harian_sm', 'rekap_bulanan_sm', 'rekap_harian_om', 'rekap_bulanan_om'));
    }
}