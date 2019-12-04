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
            $kelengkapan = kelengkapan::with('user','seksi')->get();
            if (!$kelengkapan) {
                return $this->returnController("error", "failed get kelengkapan data");
            }
            Redis::set("kelengkapan:all", $kelengkapan);
        }
        return $this->returnController("ok", $kelengkapan);
    }
}
