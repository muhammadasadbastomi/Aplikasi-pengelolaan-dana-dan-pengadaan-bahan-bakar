<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Karyawan;
use App\User;
use HCrypt;

class KaryawanController extends APIController
{
    public function get(){
        $karyawan = json_decode(redis::get("karyawan::all"));
        if (!$karyawan) {
            $karyawan = karyawan::all();
            if (!$karyawan) {
                return $this->returnController("error", "failed get karyawan data");
            }
            Redis::set("karyawan:all", $karyawan);
        }
        return $this->returnController("ok", $karyawan);
    }

    public function find($uuid){
        $id = HCrypt::decrypt($uuid);
        if (!$id) {
            return $this->returnController("error", "failed decrypt uuid");
        }
        $karyawan = Redis::get("karyawan:$id");
        if (!$karyawan) {
            $karyawan = karyawan::find($id);
            if (!$karyawan){
                return $this->returnController("error", "failed find data karyawan");
            }
            Redis::set("karyawan:$id", $karyawan);
        }
        return $this->returnController("ok", $karyawan);
    }

    public function create(Request $req){
        $user = User::create($req->all());
        // hash password
        $password=Hash::make($user->password);
        //set uuid
        $user_id = $user->id;
        $uuid = HCrypt::encrypt($user_id);
        $setuuid = User::findOrFail($user_id);
        $setuuid->uuid = $uuid;
        $setuuid->password = $password;
        $setuuid->update();

        $karyawan = $user->karyawan()->create($req->all());
        //set uuid
        $karyawan_id = $karyawan->id;
        $uuid = HCrypt::encrypt($karyawan_id);
        $setuuid = Karyawan::findOrFail($karyawan_id);
        $setuuid->uuid = $uuid;
        $setuuid->update();
        if (!$user && $karyawan) {
            return $this->returnController("error", "failed create data karyawan");
        }
        $merge = (['user' => $user, 'karyawan' => $karyawan]);
        Redis::del("karyawan:all");
        return $this->returnController("ok", $merge);
    }


}
