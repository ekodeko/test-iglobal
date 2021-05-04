<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Waybill extends Model
{
    protected $fillable   = ['user_id', 'no_waybill'];
}
