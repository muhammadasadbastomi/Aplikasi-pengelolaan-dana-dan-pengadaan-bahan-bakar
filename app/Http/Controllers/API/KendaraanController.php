<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kendaraan;
use App\Karyawan;
use HCrypt;

class KendaraanController extends APIController
{
    public function get(){
    $kendaraan = json_decode(redis::get("kendaraan::all"));
    if (!$kendaraan) {
        $kendaraan = kendaraan::with('karyawan')->get();
        if (!$kendaraan) {
            return $this->returnController("error", "failed get kendaraan data");
        }
        Redis::set("kendaraan:all", $kendaraan);
    }
    return $this->returnController("ok", $kendaraan);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $kendaraan = Redis::get("kendaraan:$id");
        if (!$kendaraan) {
            $kendaraan = kendaraan::with('karyawan')->where('id',$id)->first();
            if (!$kendaraan){
                return $this->returnController("error", "failed find data kendaraan");
            }
            Redis::set("kendaraan:$id", $kendaraan);
        }
        return $this->returnController("ok", $kendaraan);
    }

    public function create(Request $req){
        $karyawan_id = Hcrypt::decrypt($req->karyawan_id);
        $kendaraan = Karyawan::find($karyawan_id)->kendaraan()->Create($req->all());
        //set uuid
        $kendaraan_id = $kendaraan->id;
        $uuid = HCrypt::encrypt($kendaraan_id);
        $setuuid = kendaraan::findOrFail($kendaraan_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$kendaraan) {
            return $this->returnController("error", "failed create data kendaraan");
        }
        Redis::del("kendaraan:all");
        return $this->returnController("ok", $kendaraan);
    }

    public function update($uuid, Request $req){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $kendaraan = Kendaraan::findOrFail($id);
        $karyawan_id = Hcrypt::decrypt($req->karyawan_id);
        $kendaraan->karyawan_id     = $karyawan_id;
        $kendaraan->nopol    = $req->nopol;
        $kendaraan->merk    = $req->merk;
        $kendaraan->tipe    = $req->tipe;
        $kendaraan->jenis    = $req->jenis;
        $kendaraan->model    = $req->model;
        $kendaraan->tahun_pembuatan    = $req->tahun_pembuatan;
        $kendaraan->isi_silinder    = $req->isi_silinder;
        $kendaraan->warna_kendaraan    = $req->warna_kendaraan;
        $kendaraan->bahan_bakar    = $req->bahan_bakar;
        $kendaraan->warna_tnkb    = $req->warna_tnkb;
        $kendaraan->tahun_registrasi    = $req->tahun_registrasi;
        $kendaraan->no_mesin    = $req->no_mesin;
        $kendaraan->no_bpkb    = $req->no_bpkb;
        $kendaraan->tercatat_kib    = $req->tercatat_kib;
        
        $kendaraan->update();
        if (!$kendaraan) {
            return $this->returnController("error", "failed find data kendaraan");
        }
        Redis::del("kendaraan:all");
        Redis::set("kendaraan:$id", $kendaraan);
        return $this->returnController("ok", $kendaraan);
    }

    public function delete($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $kendaraan = Kendaraan::findOrFail($id);
        if (!$kendaraan) {
            return $this->returnController("error", "failed find data kendaraan");
        }
        // Need to check realational
        // If there relation to other data, return error with message, this data has relation to other table(s)
        $delete = $kendaraan->delete();
        if (!$delete) {
            return $this->returnController("error", "failed delete data kendaraan");
        }
        Redis::del("kendaraan:all");
        Redis::del("kendaraan:$id");
        return $this->returnController("ok", "success delete data kendaraan");
    }

    
}
