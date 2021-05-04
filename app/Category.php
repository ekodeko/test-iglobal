<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'thumbnail'];

    public function courses()
    {
        return $this->hasMany('App\Course');
    }
}
