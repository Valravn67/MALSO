<?php

namespace App\Imports;

use App\Model\LogisticsModel;
use Maatwebsite\Excel\Concerns\ToModel;

date_default_timezone_set("Asia/Makassar");

class LogisticsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function __construct($req)
    {
        // $this->data = $req;
    }
    public function model(array $row)
    {
        // $insert = [
        //     'warehouse_id' => $this->data->input('warehouse_id'),
        //     'note' => $this->data->input('note'),
        //     'designator' => $row[0],
        //     'designator_type' => $row[1],
        //     'unit' => $row[2],
        //     'qty' => $row[3]
        // ];
        // return new LogisticsModel($insert);
    }
}
