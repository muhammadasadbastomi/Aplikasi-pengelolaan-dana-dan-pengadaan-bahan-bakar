<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bidang;
use HCrypt;

class BidangController extends APIController
{
    public function get(){
    $bidang = json_decode(redis::get("bidang::all"));
    if (!$bidang) {
        $bidang = bidang::all();
        if (!$bidang) {
            return $this->returnController("error", "failed get bidang data");
        }
        Redis::set("bidang:all", $bidang);
    }
    return $this->returnController("ok", $bidang);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $bidang = Redis::get("bidang:$id");
        if (!$bidang) {
            $bidang = bidang::find($id);
            if (!$bidang){
                return $this->returnController("error", "failed find data bidang");
            }
            Redis::set("bidang:$id", $bidang);
        }
        return $this->returnController("ok", $bidang);
    }

    public function create(Request $req){
        $bidang = bidang::create($req->all());
        //set uuid
        $bidang_id = $bidang->id;
        $uuid = HCrypt::encrypt($bidang_id);
        $setuuid = bidang::findOrFail($bidang_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$bidang) {
            return $this->returnController("error", "failed create data bidang");
        }
        Redis::del("bidang:all");
        return $this->returnController("ok", $bidang);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $bidang = bidang::findOrFail($id);

        $bidang->kode_bidang    = $req->kode_bidang;
        $bidang->nama    = $req->nama;
        
        $bidang->update();
        if (!$bidang) {
            return $this->returnController("error", "failed find data bidang");
        }
        Redis::del("bidang:all");
        Redis::set("bidang:$id", $bidang);
        return $this->returnController("ok", $bidang);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $bidang = bidang::findOrFail($id);
        if (!$bidang) {
            return $this->returnController("error", "failed find data bidang");
        }
        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $bidang->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data bidang");
        }
        Redis::del("bidang:all");
        Redis::del("bidang:$id");
        return $this->returnController("ok", "success delete data bidang");
    }
}
