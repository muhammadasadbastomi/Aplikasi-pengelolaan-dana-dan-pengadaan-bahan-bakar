<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item_kendaraan extends Model
{
    protected $fillable = [
        'uuid','kode_item', 'nama'
    ];

    protected $hidden = [
        'id'
    ];

    public function kelengkapan()
     {
      return $this->HasOne('App\Kelengkapan');
     }
}
