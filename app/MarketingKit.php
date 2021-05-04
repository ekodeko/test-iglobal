<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MarketingKit extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'thumbnail', 'is_many_file'];

    public function items()
    {
        return $this->hasMany('App\MarketingKitItem');
    }
}
