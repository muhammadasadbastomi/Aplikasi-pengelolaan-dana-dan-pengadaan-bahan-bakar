<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $fillable = [
        'karyawan_id','uuid', 'nopol', 'merk', 'tipe', 'jenis', 'model', 'tahun_pembuatan', 'isi_silinder', 'warna_kendaraan',
        'bahan_bakar', 'warna_tnkb', 'tahun_registrasi', 'no_mesin', 'no_bpkb', 'tercatat_kib',
     ];
     protected $hidden = [
         'id', 'karyawan_id' 
     ];
 
     public function karyawan()
     {
       return $this->BelongsTo('App\Karyawan');
     }

     public function kelengkapan()
     {
      return $this->HasOne('App\Kelengkapan');
     }

     public function status_transmisi()
     {
      return $this->HasOne('App\Status_transmisi');
     }
}
