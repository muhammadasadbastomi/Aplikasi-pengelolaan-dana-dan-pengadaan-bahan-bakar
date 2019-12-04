<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelengkapan extends Model
{
    protected $fillable = [
        'uuid','kendaraan_id','item_kendaraan_id','status'
    ];

    protected $hidden = [
        'id','kendaraan_id','item_kendaraan_id'
    ];

    public function kendaraan()
    {
        return $this->belongsTo('App\Kendaraan');
    }

    public function item_kendaraan()
    {
        return $this->belongsTo('App\Item_kendaraan');
    }
}
