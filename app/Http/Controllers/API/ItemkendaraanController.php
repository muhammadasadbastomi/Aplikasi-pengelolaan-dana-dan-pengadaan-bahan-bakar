<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item_kendaraan;
use HCrypt;

class ItemkendaraanController extends APIController
{
    public function get(){
        $item_kendaraan = json_decode(redis::get("item_kendaraan::all"));
        if (!$item_kendaraan) {
            $item_kendaraan = item_kendaraan::all();
            if (!$item_kendaraan) {
                return $this->returnController("error", "failed get item_kendaraan data");
            }
            Redis::set("item_kendaraan:all", $item_kendaraan);
        }
        return $this->returnController("ok", $item_kendaraan);
    }
}
