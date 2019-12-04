<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kelengkapan;
use HCrypt;

class KelengkapanController extends APIController
{
    public function get(){
        $kelengkapan = json_decode(redis::get("kelengkapan::all"));
        if (!$kelengkapan) {
            $kelengkapan = kelengkapan::with('kendaraan','item_kendaraan')->get();
            if (!$kelengkapan) {
                return $this->returnController("error", "failed get kelengkapan data");
            }
            Redis::set("kelengkapan:all", $kelengkapan);
        }
        return $this->returnController("ok", $kelengkapan);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $kelengkapan = Redis::get("kelengkapan:$id");
        if (!$kelengkapan) {
            $kelengkapan = kelengkapan::with('kendaraan','item_kendaraan')->where('id',$id)->first();
            if (!$kelengkapan){
                return $this->returnController("error", "failed find data kelengkapan");
            }
            Redis::set("kelengkapan:$id", $kelengkapan);
        }
        return $this->returnController("ok", $kelengkapan);
    }

    
}
