<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    // use SoftDeletes;
    protected $table = 'ts_review';
    protected $fillable = ['dokter_id', 'content'];

    public function dokter()
    {
        return $this->belongsTo('App\Dokter');
    }
}
