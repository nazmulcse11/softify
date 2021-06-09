@extends('frontend.layout.app')
@section('title','Products')
@section('content')
{{-- Main content  --}}
<div class="main-content mt-5">
   <div class="container">
     <div class="row">
        <h4>Shopping Cart <span class="totalCartItems">({{ totalCartItems() }})</span></h4>
        <div id="appendCartItems">
         @include('frontend.products.cart_items')
      </div>
     </div>
     <div class="col-sm-12 text-end"><a class="btn btn-success btn-sm" href="{{ url('/checkout')}}">Checkout</a></div>
   </div>
 </div>
 @endsection
