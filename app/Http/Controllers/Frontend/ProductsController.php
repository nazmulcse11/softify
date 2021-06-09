<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Models\Shippingaddress;
use App\Models\OrdersProduct;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;
use Session;
use Auth;
use DB;


class ProductsController extends Controller
{
  public function products(){
     $products = Product::get()->toArray();
     return view('frontend.products.products',compact('products'));
  }

  public function addToCart(Request $request, $id=null){
   $productDetails = Product::find($id)->toArray();
   // check product if already exists in user cart
   if(Auth::check()){
      //if user is logged in
      $productCount = Cart::where(['product_id'=>$productDetails['id'],'user_id'=>Auth::user()->id])->count();
   }
   if($productCount > 0){
      session::flash('error_message','product already exists in cart');
      return redirect()->back();
   }
   $addToCart = new Cart();
   $addToCart->user_id = Auth::user()->id;
   $addToCart->product_id = $productDetails['id'];
   $addToCart->quantity = 1;
   $addToCart->save();

   return redirect('/cart');
  }

  public function cartItems(){
   $userCartItems = Cart::userCartItems();
   return view('frontend.products.cart',compact('userCartItems'));
  }

  public function updateCartItemQty(Request $request){
   if($request->ajax()){
      $data = $request->all();
      // echo "<pre>";print_r($data);die;
      //get cart details
      $cartDetails = Cart::find($data['cartid']);

      //available stock in products table
      $availableStock = Product::select('product_stock')->where(['id'=>$cartDetails['product_id']])->first()->toArray();
        
      //check user demanded quantity is available
      if($data['qty']>$availableStock['product_stock']){
         $userCartItems = Cart::userCartItems();
         return response()->json([
            'status' => false,
            'view'=>(String)View::make('frontend.products.cart_items',compact('userCartItems'))
         ]);
      }

      Cart::where('id',$data['cartid'])->update(['quantity'=>$data['qty']]);
      $userCartItems = Cart::userCartItems();
      $totalCartItems = totalCartItems();
      return response()->json([
         'status' => true,
         'totalCartItems' => $totalCartItems,
         'view'=>(String)View::make('frontend.products.cart_items',compact('userCartItems'))
      ]);
   }
}

   //delete cart item
   public function deleteCartItem(Request $request){
      if($request->ajax()){
         $data = $request->all();
         $deleteCart = Cart::where('id',$data['cartid'])->delete();
         $userCartItems = Cart::userCartItems();
         $totalCartItems = totalCartItems();
         return response()->json([
            'totalCartItems' => $totalCartItems,
            'view'=>(String)View::make('frontend.products.cart_items',compact('userCartItems'))
         ]);
      }
   }

   public function checkout(Request $request){
      if($request->isMethod('post')){
         $data = $request->all();

         if(empty($data['address_id'])){
            Session::flash('error_message','Please check address');
            return redirect()->back();
         }
         if(empty($data['payment_gateway'])){
            Session::flash('error_message','Please check payment gateway');
            return redirect()->back();
         }

         if($data['payment_gateway']=='COD'){
            $payment_method = 'COD';
         }else{
            echo 'Comming Soon';die;
            $payment_method = 'Prepaid';
         }
         //get shipping address details from address_id
         $getShippingAddress = Shippingaddress::where(['id'=>$data['address_id']])->first()->toArray();
         
         DB::beginTransaction();

         //Insert order details
         $order = new Order();
         $order->user_id = Auth::user()->id;
         $order->name = $getShippingAddress['name'];
         $order->email = $getShippingAddress['email'];
         $order->phone = $getShippingAddress['phone'];
         $order->address = $getShippingAddress['address'];
         $order->shipping_charge = 0;
         $order->order_status = 'New';
         $order->payment_method  = $payment_method;
         $order->payment_gateway  = $data['payment_gateway'];
         $order->total_price  = Session::get('total_price');
         $order->save();

         $order_id = DB::getPdo()->lastInsertId();
         $cartItems = Cart::where(['user_id'=>Auth::user()->id])->get()->toArray();

         foreach($cartItems as $item){
            $cartItem = new OrdersProduct();
            $cartItem->order_id = $order_id;
            $cartItem->user_id = Auth::user()->id;
            $productDetails = Product::where(['id'=>$item['product_id']])->first()->toArray();
            $cartItem->product_id = $productDetails['id']; 
            $cartItem->product_name = $productDetails['product_name']; 
            $cartItem->product_code = $productDetails['product_code']; 
            $cartItem->product_color = $productDetails['product_color']; 
            $cartItem->product_price = $productDetails['product_price']; 
            $cartItem->product_quantity = $item['quantity']; 
            $cartItem->save();
         }

         //empty user cart items
         Cart::where(['user_id'=>Auth::user()->id])->delete();

         //Insert order id in session variable
         Session::put('order_id',$order_id);
         
         DB::commit();

         if($data['payment_gateway']=='COD'){
            return redirect('/thanks');
         }else{
            echo 'Comming Soon';die;
         }
      }

      //get shipping address to show in checkout page
      $shippingAddress = Shippingaddress::where('user_id',Auth::user()->id)->get()->toArray();
      $userCartItems = Cart::userCartItems();
     return view('frontend.products.checkout',compact('shippingAddress','userCartItems'));
   }

   //thanks page
   public function thanks(){
      if(Session::has('order_id')){
         return view('frontend.products.thanks');
      }else{
         return redirect('cart');
      }
      
   }

   public function addEditAddress(Request $request, $id=null){
      if(empty($id)){
         $title = 'Add Shipping Address';
         $addressData = array();
         $address = new Shippingaddress();
         $message = 'Address successfully added';
      }else{
         $title = 'Add Shipping Address';
         $addressData = Shippingaddress::find($id)->toArray();
         $address = Shippingaddress::find($id);
         $message = 'Address successfully updated';
      }

      if($request->isMethod('post')){
         $data = $request->all();
         $rules = [
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'phone' => 'required|numeric',
            'address' => 'required',
         ];
         $customMessage = [
            'name.required' => 'Name is required',
            'name.regex' => 'Valid name is required',
            'phone.required' => 'Phone number is required',
            'phone.numeric' => 'Valid phone number is required',
            'address.required' => 'Address is required',
         ];

         $this->validate($request,$rules,$customMessage);
         $address->user_id = Auth::user()->id; 
         $address->name = $data['name'];
         $address->email = $data['email'];
         $address->phone = $data['phone'];
         $address->address = $data['address'];
         $address->save();
         Session::flash('success_message',$message);
         return redirect('/checkout');
      }
      return view('frontend.products.add_edit_address',compact('title','addressData'));
   }

   public function deleteShippingAddress($id){
      $deleteShippingAddress = ShippingAddress::find($id)->delete();
      Session::flash('success_message','Shipping address successfully deleted');
      return redirect()->back();
   }

}