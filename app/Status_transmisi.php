<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status_transmisi extends Model
{
    public function objek_transmisi()
    {
        return $this->belongsTo('App\Objek_transmisi');
    }

    public function kendaraan()
    {
        return $this->belongsTo('App\Kendaraan');
    }
}
