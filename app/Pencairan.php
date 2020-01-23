<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pencairan extends Model
{
    public function rincian()
    {
    	return $this->belongsToMany('App\Rincian');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
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
