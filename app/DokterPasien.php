<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DokterPasien extends Model
{
    //
    // use SoftDeletes;
    protected $table = 'ts_dokter_pasien';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function dokter()
    {
        # code...
        return $this->belongsTo('App\Dokter');
    }
    public function user()
    {
        # code...
        return $this->belongsTo('App\User');
    }
}
