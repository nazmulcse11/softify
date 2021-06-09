@extends('frontend.layout.app')
@section('title','Thanks')
@section('content')
{{-- Main content  --}}
<div class="main-content mt-5">
   <div class="container">
     <div class="row text-center">
        <h4>Your Order Successfully Compleated</h4>
        <p>Your order number is #{{ Session::get('order_id') }} and total price is 
      BDT {{ Session::get('total_price') }}</p>
     </div>
   </div>
 </div>
 @endsection

 <?php
 Session::forget('order_id');
 Session::forget('total_price');
 ?>