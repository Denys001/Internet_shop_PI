<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function product(){
        $product = Product::find($this->id_product);
        return $product;
    }
    public function user(){
        $user = User::find($this->id_user);
        return $user;
    }
}
