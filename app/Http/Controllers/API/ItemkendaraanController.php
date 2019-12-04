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

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $item_kendaraan = Redis::get("item_kendaraan:$id");
        if (!$item_kendaraan) {
            $item_kendaraan = item_kendaraan::find($id);
            if (!$item_kendaraan){
                return $this->returnController("error", "failed find data item_kendaraan");
            }
            Redis::set("item_kendaraan:$id", $item_kendaraan);
        }
        return $this->returnController("ok", $item_kendaraan);
    }

    public function create(Request $req){
        $item_kendaraan = item_kendaraan::create($req->all());
        //set uuid
        $item_kendaraan_id = $item_kendaraan->id;
        $uuid = HCrypt::encrypt($item_kendaraan_id);
        $setuuid = item_kendaraan::findOrFail($item_kendaraan_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$item_kendaraan) {
            return $this->returnController("error", "failed create data item_kendaraan");
        }
        Redis::del("item_kendaraan:all");
        return $this->returnController("ok", $item_kendaraan);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $item_kendaraan = item_kendaraan::findOrFail($id);

        $item_kendaraan->kode_item    = $req->kode_item;
        $item_kendaraan->nama    = $req->nama;
        
        $item_kendaraan->update();
        if (!$item_kendaraan) {
            return $this->returnController("error", "failed find data item_kendaraan");
        }
        Redis::del("item_kendaraan:all");
        Redis::set("item_kendaraan:$id", $item_kendaraan);
        return $this->returnController("ok", $item_kendaraan);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $item_kendaraan = item_kendaraan::findOrFail($id);
        if (!$item_kendaraan) {
            return $this->returnController("error", "failed find data item_kendaraan");
        }
        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $item_kendaraan->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data item_kendaraan");
        }
        Redis::del("item_kendaraan:all");
        Redis::del("item_kendaraan:$id");
        return $this->returnController("ok", "success delete data item_kendaraan");
    }
}
