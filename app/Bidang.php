<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    protected $fillable = [
        'uuid', 'kode_bidang','nama', 
    ];

    protected $hidden = [
        'id'
    ];

    public function seksi()
    {
        return $this->HasMany('App\Seksi');
    }
}
