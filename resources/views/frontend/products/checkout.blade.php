@extends('frontend.layout.app')
@section('title','Checkout')
@section('content')
{{-- Main content  --}}
<div class="main-content mt-5">
   <div class="container">
     <div class="row">
      @if(Session::has('success_message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('success_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      @if(Session::has('error_message'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ Session::get('error_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
       
      <form name="checkoutForm" action="{{ url('checkout') }}" method="post">  
         @csrf
        <h4>Shipping Address <span><a class="btn btn-success btn-sm" href="{{ url('/add-edit-address') }}">Add</a></span></h4> 
        <table class="table table-bordered">
           @foreach($shippingAddress as $address)
           <tr>
              <td>
               <input type="radio" name="address_id" id="address{{ $address['id'] }}" value="{{ $address['id']}}">  
               Name:     {{ $address['name']}} &nbsp;
               Email:    {{ $address['email']}} &nbsp;
               Phone:    {{ $address['phone']}} &nbsp;
               Details:  {{ $address['address']}}
            </td>
            <td><a href="{{ url('add-edit-address/'.$address['id']) }}">Edit</a></td>
            <td><a href="{{ url('delete-shipping-address/'.$address['id']) }}" onclick="return confirm('Are you sure to delete??')">Delt</a></td>
           </tr>
           @endforeach
        </table>

        <h4 class="mt-5">Checkout <span class="totalCartItems">({{ totalCartItems() }})</span></h4>
        <table class="table table-bordered">
         <thead>
            <tr>
               <th>Image</th>
               <th>Details</th>
               <th>Quantity</th>
               <th>Unit Price</th>
               <th>Sub Total</th>
            </tr>
         </thead>
         <tbody>
            <?php $total_price = 0; ?>
            @foreach($userCartItems as $items)
            <tr>
               <td><img style="width:50px" src="{{ asset('images/products/'.$items['product']['product_image']) }}" alt="img"></td>
               <td>
                  {{ $items['product']['product_name']}} <br>
                  {{ $items['product']['product_code']}} <br>
                  {{ $items['product']['product_color']}}
               </td>
               <td>
                  <input style="max-width:34px" value="{{ $items['quantity'] }}" id="appendedInputButtons" size="16" type="text">
                 </td>
               <td>{{ $items['product']['product_price'] }}</td>
               <td>{{ $items['quantity'] * $items['product']['product_price'] }}</td>
            </tr>
            <?php $total_price = $total_price+($items['quantity'] * $items['product']['product_price']) ?>
            @endforeach
            <tr>
              <td colspan="4" class="text-end">Total Price</td>
              <td>{{ $total_price }} <?php Session::put('total_price',$total_price)?></td>
           </tr>
         </tbody>
         </table>
         <div class="col-sm-6">
            <h4>Payment With</h4>
            <input type="radio" name="payment_gateway" id="COD" value="COD"> COD
            <input type="radio" name="payment_gateway" id="paypal" value="Paypal"> Paypal
            <input type="radio" name="payment_gateway" id="ssl_commerce" value="SSL Commerce"> SSL Commerce
         </div>
         <div class="col-sm-6 text-end">
            <input type="submit" class="btn btn-success" value="Place Order">
         </div>
      </form>
     </div>
   </div>
 </div>
 @endsection
