<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $fillable = [
        'NIP', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'telepon'
    ];
    protected $hidden = [
        'id', 'user_id'
    ];

    public function user(){
      return $this->HasOne('App\User');
    }
}
