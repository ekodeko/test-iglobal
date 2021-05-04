<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;
    protected $fillable = ['category_id', 'title', 'link_embed', 'level_requirement'];

    public function category()
    {
        return $this->belongsTo('App\category');
    }
}
