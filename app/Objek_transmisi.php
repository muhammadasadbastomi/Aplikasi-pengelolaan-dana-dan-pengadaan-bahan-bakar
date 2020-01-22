<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objek_transmisi extends Model
{
    protected $fillable = [
        'uuid', 'kode_transmisi','jenis', 
    ];

    protected $hidden = [
        'id'
    ];

    public function status_transmisi()
    {
        return $this->HasMany('App\Status_transmisi');
    }
}
