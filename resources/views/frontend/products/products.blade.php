@extends('frontend.layout.app')
@section('title','Products')
@section('content')
{{-- Main content  --}}
<div class="main-content mt-5">
   <div class="container">
      @if(Session::has('error_message'))
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ Session::get('error_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      <div id="scrollAjaxData">
        @include('frontend.products.products_data')
      </div>
   </div>
   <div class="ajax-load text-center" style="display:none">
    <p><img src="{{ url('images/loader/loader.gif')  }}"></p>
  </div>
 </div>
 @endsection



