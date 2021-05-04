<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketingKitItem extends Model
{
    protected $fillable = ['marketing_kit_id', 'title', 'thumbnail'];
    public function marketing_kit()
    {
        return $this->belongsTo('App\MarketingKit');
    }
}
