<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Session;


class OrdersController extends Controller
{
    public function orders(){
        Session::put('page','orders');
       $orders = Order::with('orderProducts')->get()->toArray();
    //    echo "<pre>"; print_r($orders);die;
       return view('backend.orders.orders',compact('orders'));
    }
}
