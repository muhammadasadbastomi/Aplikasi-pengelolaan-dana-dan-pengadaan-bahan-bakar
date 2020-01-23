<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Objek_transmisi;
use App\Status_transmisi;
use HCrypt;

class StatusController extends APIController
{
    public function get(){
        $status_transmisi = json_decode(redis::get("status_transmisi::all"));
        if (!$status_transmisi) {
            $status_transmisi = status_transmisi::with('objek_transmisi','kendaraan')->get();
            if (!$status_transmisi) {
                return $this->returnController("error", "failed get status_transmisi data");
            }
            Redis::set("status_transmisi:all", $status_transmisi);
        }
        return $this->returnController("ok", $status_transmisi);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $status_transmisi = Redis::get("status_transmisi:$id");
        if (!$status_transmisi) {
            $status_transmisi = status_transmisi::with('kendaraan','objek_transmisi')->where('id',$id)->first();
            if (!$status_transmisi){
                return $this->returnController("error", "failed find data status_transmisi");
            }
            Redis::set("status_transmisi:$id", $status_transmisi);
        }
        return $this->returnController("ok", $status_transmisi);
    }

    public function create(Request $req){
        // $status_transmisi = status_transmisi::create($req->all());
        $status_transmisi = new status_transmisi;
        $status_transmisi->status = $req->status;
        // decrypt objek_transmisi id
        $status_transmisi->objek_transmisi_id = Hcrypt::decrypt($req->objek_transmisi_id);
        $status_transmisi->kendaraan_id = Hcrypt::decrypt($req->kendaraan_id);
        $status_transmisi->save();
        //set uuid
        $status_transmisi_id = $status_transmisi->id;
        $uuid = HCrypt::encrypt($status_transmisi_id);
        $setuuid = status_transmisi::findOrFail($status_transmisi_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$status_transmisi) {
            return $this->returnController("error", "failed create data status_transmisi");
        }
        Redis::del("status_transmisi:all");
        Redis::set("status_transmisi:all", $status_transmisi);
        return $this->returnController("ok", $status_transmisi);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $status_transmisi = status_transmisi::findOrFail($id);
        
        $status_transmisi->status    = $req->status;
        $status_transmisi->objek_transmisi_id = Hcrypt::decrypt($req->objek_transmisi_id);
        $status_transmisi->kendaraan_id = Hcrypt::decrypt($req->kendaraan_id);
        $status_transmisi->update();
        if (!$status_transmisi) {
            return $this->returnController("error", "failed find data status_transmisi");
        }
        $status_transmisi = status_transmisi::with('objek_transmisi','kendaraan')->where('id',$id)->first();
        Redis::del("status_transmisi:all");
        Redis::set("status_transmisi:$id", $status_transmisi);
        return $this->returnController("ok", $status_transmisi);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $status_transmisi = status_transmisi::find($id);
        if (!$status_transmisi) {
            return $this->returnController("error", "failed find data status_transmisi");
        }
        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $status_transmisi->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data status_transmisi");
        }
        Redis::del("status_transmisi:all");
        Redis::del("status_transmisi:$id");
        return $this->returnController("ok", "success delete data status_transmisi");
    }
}
