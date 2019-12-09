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

    public function create(Request $req){
        $kelengkapan = new kelengkapan;
        $kelengkapan->status = $req->status;
        // decrypt kendaraan & item kendaraan id
        $kendaraan_id = Hcrypt::decrypt($req->kendaraan_id);
        $item_kendaraan_id = Hcrypt::decrypt($req->item_kendaraan_id);
        $kelengkapan->kendaraan_id = $kendaraan_id;
        $kelengkapan->item_kendaraan_id = $item_kendaraan_id;
        $kelengkapan->save();
        //set uuid
        $kelengkapan_id = $kelengkapan->id;
        $uuid = HCrypt::encrypt($kelengkapan_id);
        $setuuid = kelengkapan::findOrFail($kelengkapan_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$kelengkapan) {
            return $this->returnController("error", "failed create data kelengkapan");
        }
        Redis::del("kelengkapan:all");
        Redis::set("kelengkapan:all", $kelengkapan);
        return $this->returnController("ok", $kelengkapan);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $kelengkapan = kelengkapan::findOrFail($id);
        $kendaraan_id = Hcrypt::decrypt($req->kendaraan_id);
        $kelengkapan->kendaraan_id     = $kendaraan_id;
        $kelengkapan->kendaraan_id = $kendaraan_id;
        $kelengkapan->item_kendaraan_id = $item_kendaraan_id;
        
        $kelengkapan->update();
        if (!$kelengkapan) {
            return $this->returnController("error", "failed find data kelengkapan");
        }
        $kelengkapan = kelengkapan::with('karyawan')->where('id',$id)->first();
        Redis::del("kelengkapan:all");
        Redis::set("kelengkapan:$id", $kelengkapan);
        return $this->returnController("ok", $kelengkapan);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $kelengkapan = kelengkapan::findOrFail($id);
        if (!$kelengkapan) {
            return $this->returnController("error", "failed find data kelengkapan");
        }
        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $kelengkapan->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data kelengkapan");
        }
        Redis::del("kelengkapan:all");
        Redis::del("kelengkapan:$id");
        return $this->returnController("ok", "success delete data kelengkapan");
    }
}
