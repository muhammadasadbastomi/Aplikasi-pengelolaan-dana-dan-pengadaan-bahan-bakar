<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hcrypt;

class Seksi extends Model
{
    protected $fillable = [
        'uuid','bidang_id','kode_seksi','nama',
    ];

    protected $hidden = [
        'id','bidang_id'
    ];

    public function bidang()
    {
        return $this->belongsTo('App\Bidang');
    }

    // public function setBidang_idAttribute($value)
    // {
    //     $this->attributes['bidang_id'] = Hcrypt::decrypt($value);
    // }
}
