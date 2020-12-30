<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    // use SoftDeletes;
    protected $table = 'ms_roles';
    protected $fillable = ['name'];

    public function user()
    {
        return $this->hasOne('App\User');
    }
}
