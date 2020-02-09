<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pencairan;
use App\Rincian;
use HCrypt;
use Illuminate\Support\Facades\Redis;

class RincianController extends APIController
{
    public function get($uuid){
        $id = HCrypt::decrypt($uuid);
        $rincian = json_decode(redis::get("rincian::all"));
        if (!$rincian) {
            $rincian = rincian::with('kendaraan')->where('pencairan_id',$id)->get();
            if (!$rincian) {
                return $this->returnController("error", "failed get rincian data");
            }
            Redis::set("rincian:all", $rincian);

        }
        return $this->returnController("ok", $rincian);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $rincian = Redis::get("rincian:$id");
        if (!$rincian) {
            $rincian = rincian::find($id);
            if (!$rincian){
                return $this->returnController("error", "failed find data rincian");
            }
            Redis::set("rincian:$id", $rincian);
        }

        return $this->returnController("ok", $rincian);
    }

    public function create(Request $req){
        $total_harga_item = $req->volume * $req->harga_satuan;

        $rincian = new rincian;

        // $rincian->pencairan_id = $req->pencairan_id;
        $rincian->kendaraan_id = HCrypt::decrypt($req->kendaraan_id);
        $rincian->pencairan_id = HCrypt::decrypt($req->pencairan_id);
        $rincian->tanggal_transaksi = $req->tanggal_transaksi;
        $rincian->nama_item = $req->nama_item;
        $rincian->satuan = $req->satuan;
        $rincian->harga_satuan = $req->harga_satuan;
        $rincian->volume = $req->volume;
        $rincian->total_harga_item = $total_harga_item;
        $rincian->save();

        // if($item->keperluan == "Belanja Gajih Pegawai Kontrak" || "Belanja Makan Minum Harian")
        // {
        //     //create sum total pencairan
        //     $pencairan = Pencairan::findOrFail($rincian->pencairan_id);
        //     $pencairan->total = $rincian->total_harga_item;
        //     $pencairan->update();
        // }

        $rincian_id= $rincian->id;
        $uuid = HCrypt::encrypt($rincian_id);
        $setuuid = rincian::findOrFail($rincian_id);
        $setuuid->uuid = $uuid;

        $setuuid->update();
        if (!$rincian) {
            return $this->returnController("error", "failed create data rincian");
        }
        Redis::del("rincian:all");
        Redis::set("rincian:all",$rincian);
        return $this->returnController("ok", $rincian);
    }



    public function update($uuid, Request $req){
        $total_harga_item = $req->volume * $req->harga_satuan;
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $rincian = rincian::findOrFail($id);
        if (!$rincian) {
            return $this->returnController("error", "failed find data rincian");
        }
        $rincian->tanggal_transaksi = $req->tanggal_transaksi;
        $rincian->nama_item = $req->nama_item;
        $rincian->satuan = $req->satuan;
        $rincian->harga_satuan = $req->harga_satuan;
        $rincian->volume = $req->volume;
        $rincian->total_harga_item = $total_harga_item;

        $rincian->update();
        if (!$rincian) {
            return $this->returnController("error", "failed find data rincian");
        }

        Redis::del("rincian:all");
        Redis::set("rincian:$id", $rincian);

        return $this->returnController("ok", $rincian);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }

        $rincian = rincian::find($id);
        if (!$rincian) {
            return $this->returnController("error", "failed find data rincian");
        }

        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)

        $delete = $rincian->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data rincian");
        }

        Redis::del("rincian:all");
        Redis::del("rincian:$id");
        return $this->returnController("ok", "success delete data rincian");
    }
}
