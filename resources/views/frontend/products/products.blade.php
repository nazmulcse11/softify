@extends('frontend.layout.app')
@section('title','Products')
@section('content')
{{-- Main content  --}}
<div class="main-content mt-5">
   <div class="container">
     <div class="row">
      @if(Session::has('error_message'))
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ Session::get('error_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
        @foreach($products as $product)
       <div class="col-md-3 py-2">
         <div class="card">
           <img src="{{ url('images/products/'.$product['product_image']) }}" class="card-img-top" alt="...">
           <div class="card-body">
             <h5 class="card-title">{{ $product['product_name'] }}</h5>
           </div>
           <div class="card-body">
             <span>BDT: {{ $product['product_price'] }}</span> 
             <a href="{{ url('/add-to-cart/'.$product['id']) }}" class="btn btn-primary btn-sm">Add To Cartk</a>
           </div>
         </div>
       </div>
       @endforeach
     </div>
   </div>
 </div>
 @endsection
