<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    public $timestamps = false;
    public function Product(){
        $product = Product::where('id', $this->id_product)->first();
        return $product;
    }
}
