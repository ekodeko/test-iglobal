<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    //
    use SoftDeletes;
    protected $table = 'ts_booking';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function dokter()
    {
        # code...
        return $this->belongsTo('App\Dokter', 'id_dokter');
    }
}
