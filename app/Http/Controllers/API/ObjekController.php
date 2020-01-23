<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Status_transmisi;
use App\Objek_transmisi;
use HCrypt;

class ObjekController extends APIController
{
    public function get(){
        $objek_transmisi = json_decode(redis::get("objek_transmisi::all"));
        if (!$objek_transmisi) {
            $objek_transmisi = objek_transmisi::with('status_transmisi')->get();
            if (!$objek_transmisi) {
                return $this->returnController("error", "failed get objek_transmisi data");
            }
            Redis::set("objek_transmisi:all", $objek_transmisi);
        }
        return $this->returnController("ok", $objek_transmisi);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $objek_transmisi = Redis::get("objek_transmisi:$id");
        if (!$objek_transmisi) {
            $objek_transmisi = objek_transmisi::with('bidang')->where('id',$id)->first();
            if (!$objek_transmisi){
                return $this->returnController("error", "failed find data objek_transmisi");
            }
            Redis::set("objek_transmisi:$id", $objek_transmisi);
        }
        return $this->returnController("ok", $objek_transmisi);
    }

    public function create(Request $req){
        $objek_transmisi = objek_transmisi::create($req->all());
        $objek_transmisi_id = $objek_transmisi->id;
        $uuid = HCrypt::encrypt($objek_transmisi_id);
        $setuuid = objek_transmisi::findOrFail($objek_transmisi_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$objek_transmisi) {
            return $this->returnController("error", "failed create data objek_transmisi");
        }
        Redis::del("objek_transmisi:all");
        Redis::set("objek_transmisi:all", $objek_transmisi);
        return $this->returnController("ok", $objek_transmisi);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $objek_transmisi = objek_transmisi::findOrFail($id);
        
        $objek_transmisi->fill($req->all())->save();

        $objek_transmisi->update();
        if (!$objek_transmisi) {
            return $this->returnController("error", "failed find data objek_transmisi");
        }
        $objek_transmisi = objek_transmisi::with('status_transmisi')->where('id',$id)->first();
        Redis::del("objek_transmisi:all");
        Redis::set("objek_transmisi:$id", $objek_transmisi);
        return $this->returnController("ok", $objek_transmisi);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $objek_transmisi = objek_transmisi::find($id);
        if (!$objek_transmisi) {
            return $this->returnController("error", "failed find data objek_transmisi");
        }
        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $objek_transmisi->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data objek_transmisi");
        }
        Redis::del("objek_transmisi:all");
        Redis::del("objek_transmisi:$id");
        return $this->returnController("ok", "success delete data objek_transmisi");
    }
}
