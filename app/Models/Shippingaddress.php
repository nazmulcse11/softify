<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Shippingaddress extends Model
{
    use HasFactory;

    public static function shippingAddress(){
        $user_id = Auth::user()->id;
        $address = Shippingaddress::where('user_id',$user_id)->get()->toArray();
        return $address;
    }
}
