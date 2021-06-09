<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Cart extends Model
{
    use HasFactory;
    public static function userCartItems(){
    	if(Auth::check()){
    	   $userCartItems = Cart::with('product')->where('user_id',Auth::user()->id)->get()->toArray();	
    	}
    	return $userCartItems;
    } 

    public function product(){
    	return $this->belongsTo('App\Models\Product','product_id');
    }
}
