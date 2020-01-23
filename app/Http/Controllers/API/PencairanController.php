<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pencairan;
use App\Rincian;
use HCrypt;
use Illuminate\Support\Facades\Redis;

class PencairanController extends APIController
{
    public function get(){
        $pencairan = json_decode(redis::get("pencairan::all"));
        if (!$pencairan) {
            $pencairan = pencairan::with('user')->get();
            if (!$pencairan) {
                return $this->returnController("error", "failed get pencairan data");
            }
            Redis::set("pencairan:all", $pencairan);            

        }
        return $this->returnController("ok", $pencairan);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $pencairan = Redis::get("pencairan:$id");
        if (!$pencairan) {
            $pencairan = pencairan::find($id);
            if (!$pencairan){
                return $this->returnController("error", "failed find data pencairan");
            }
            Redis::set("pencairan:$id", $pencairan);
        }

        return $this->returnController("ok", $pencairan);
    }

    public function create(Request $req){
        $id = $req->id_pencairan;
        $total_harga = rincian::where('pencairan_id',$id)->get()->sum('total_harga_item');
        $pencairan = pencairan::findOrFail($id);

        $pencairan->total = $total_harga;
        
        $pencairan->update();

        if (!$pencairan) {
            return $this->returnController("error", "failed update data pencairan");
        }
        Redis::del("pencairan:all");
        Redis::set("pencairan:$id", $pencairan);
        return $this->returnController("ok", $pencairan);
    }

    

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $pencairan = pencairan::findOrFail($id);
        if (!$pencairan) {
            return $this->returnController("error", "failed find data pencairan");
        }

        $pencairan->pencairan     = $req->pencairan;
        $pencairan->keterangan    = $req->keterangan;
        $pencairan->update();
        if (!$pencairan) {
            return $this->returnController("error", "failed find data pencairan");
        }

        Redis::del("pencairan:all");
        Redis::set("pencairan:$id", $pencairan);

        return $this->returnController("ok", $pencairan);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $pencairan = pencairan::find($id);
        if (!$pencairan) {
            return $this->returnController("error", "failed find data pencairan");
        }

        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)

        $delete = $pencairan->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data pencairan");
        }

        Redis::del("pencairan:all");
        Redis::del("pencairan:$id");
        return $this->returnController("ok", "success delete data pencairan");
    }
}
