<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kendaraan;
use HCrypt;

class KendaraanController extends APIController
{
    public function get(){
    $kendaraan = json_decode(redis::get("kendaraan::all"));
    if (!$kendaraan) {
        $kendaraan = kendaraan::all();
        if (!$kendaraan) {
            return $this->returnController("error", "failed get kendaraan data");
        }
        Redis::set("kendaraan:all", $kendaraan);
    }
    return $this->returnController("ok", $kendaraan);
    }

    
}
