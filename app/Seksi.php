<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seksi extends Model
{
    protected $fillable = [
        'uuid','kode_seksi','nama',
    ];

    protected $hidden = [
        'id','bidang_id'
    ];

    public function bidang()
    {
        return $this->belongsTo('App\Bidang');
    }
}
