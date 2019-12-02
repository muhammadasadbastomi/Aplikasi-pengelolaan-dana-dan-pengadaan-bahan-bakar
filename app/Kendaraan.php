<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $fillable = [
        'uuid', 'nopol', 'merk', 'tipe', 'jenis', 'model', 'tahun_pembuatan', 'isi_silinder', 'warna_kendaraan',
        'bahan_bakar', 'warna_tnkb', 'tahun_registrasi', 'no_mesin', 'no_bpkb', 'tercatat_kib',
     ];
     protected $hidden = [
         'id', 'karyawan_id'
     ];
 
     public function karyawan(){
       return $this->HasOne('App\Karyawan');
     }

}
