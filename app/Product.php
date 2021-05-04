<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = ['original_code', 'product_name', 'product_price', 'cogs'];

    public $product_per_box = 70;
    public $product_het = 6250;

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
