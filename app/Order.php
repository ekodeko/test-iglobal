<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id'];

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
