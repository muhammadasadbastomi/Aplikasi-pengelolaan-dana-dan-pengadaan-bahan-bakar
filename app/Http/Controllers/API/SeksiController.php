<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bidang;
use App\Seksi;
use HCrypt;

class SeksiController extends APIController
{
    public function get(){
        $seksi = json_decode(redis::get("seksi::all"));
        if (!$seksi) {
            $seksi = seksi::with('bidang')->get();
            if (!$seksi) {
                return $this->returnController("error", "failed get seksi data");
            }
            Redis::set("seksi:all", $seksi);
        }
        return $this->returnController("ok", $seksi);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $seksi = Redis::get("seksi:$id");
        if (!$seksi) {
            $seksi = seksi::with('bidang')->where('id',$id)->first();
            if (!$seksi){
                return $this->returnController("error", "failed find data seksi");
            }
            Redis::set("seksi:$id", $seksi);
        }
        return $this->returnController("ok", $seksi);
    }

    public function create(Request $req){
        // $seksi = Seksi::create($req->all());
        $seksi = new Seksi;
        $seksi->kode_seksi = $req->kode_seksi;
        $seksi->nama = $req->nama;
        // decrypt bidang id
        $seksi->bidang_id = Hcrypt::decrypt($req->bidang_id);
        $seksi->save();
        //set uuid
        $seksi_id = $seksi->id;
        $uuid = HCrypt::encrypt($seksi_id);
        $setuuid = seksi::findOrFail($seksi_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$seksi) {
            return $this->returnController("error", "failed create data seksi");
        }
        Redis::del("seksi:all");
        Redis::set("user:all", $user);
        return $this->returnController("ok", $seksi);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $seksi = seksi::findOrFail($id);
        $seksi->kode_seksi     = $req->kode_seksi;
        $seksi->nama    = $req->nama;
        $seksi->bidang_id = Hcrypt::decrypt($req->bidang_id);
        $seksi->update();
        if (!$seksi) {
            return $this->returnController("error", "failed find data seksi");
        }
        $seksi = seksi::with('bidang')->where('id',$id)->first();
        Redis::del("seksi:all");
        Redis::set("seksi:$id", $seksi);
        return $this->returnController("ok", $seksi);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $seksi = seksi::find($id);
        if (!$seksi) {
            return $this->returnController("error", "failed find data seksi");
        }
        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $seksi->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data seksi");
        }
        Redis::del("seksi:all");
        Redis::del("seksi:$id");
        return $this->returnController("ok", "success delete data seksi");
    }
}
