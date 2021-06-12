<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderStatus;
use App\Models\Order;
use App\Models\User;
use Session;


class OrdersController extends Controller
{
    public function orders(){
        Session::put('page','orders');
       $orders = Order::with('orderProducts')->get()->toArray();
    //    echo "<pre>"; print_r($orders);die;
       return view('backend.orders.orders',compact('orders'));
    }

    //order details
    public function orderDetails($id){
        // $orderDetails = Order::with('orderProducts')->where(['id'=>$id])->first()->toArray();
        $orderDetails = Order::with('orderProducts')->find($id)->toArray();
        $userDetails = User::where(['id'=>$orderDetails['user_id']])->first()->toArray();
        $orderStatuses = OrderStatus::where(['status'=>1])->get()->toArray();
        // echo "<pre>"; print_r($orderStatuses);die;
        return view('backend.orders.order_details',compact('orderDetails','userDetails','orderStatuses'));
    }

    //update order status
    public function updateOrderStatus(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            Order::where('id',$data['order_id'])->update(['order_status'=>$data['update_status']]);
            Session::flash('success_message','Order status successfully updated');
            return redirect()->back();
        }
    }
}
