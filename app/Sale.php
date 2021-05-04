<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['quantity'];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
