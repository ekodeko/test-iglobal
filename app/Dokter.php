<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    //
    use SoftDeletes;
    protected $table = 'ms_dokter';
    protected $fillable = ['nama_dokter', 'telp'];

    public function certificate()
    {
        # code...
        return $this->hasOne('App\Certificate');
    }
    public function reviews()
    {
        # code...
        return $this->hasMany('App\Review');
    }
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
