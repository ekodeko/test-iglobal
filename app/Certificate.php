<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    //
    use SoftDeletes;
    protected $table = 'ms_certificate';
    protected $fillable = ['certificate_number'];

    public function dokter()
    {
        return $this->belongsTo('App\Dokter');
    }
}
