<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rincian extends Model
{
    protected $hidden = [
        'id','item_id','pencairan_id',
    ];

    public function item()
    {
        return $this->belongsTo('App\Item');
    }

    public function kendaraan()
    {
        return $this->belongsTo('App\Kendaraan');
    }

    public function getCreatedAtAttribute()
    {
    return \Carbon\Carbon::parse($this->attributes['created_at'])
       ->format('d, M Y');
    }

    public function getUpdatedAtAttribute()
    {
    return \Carbon\Carbon::parse($this->attributes['updated_at'])
       ->diffForHumans();
    }
}
