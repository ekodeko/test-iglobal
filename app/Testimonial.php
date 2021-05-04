<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id', 'title', 'content', 'picture', 'link'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
