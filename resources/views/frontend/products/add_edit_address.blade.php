@extends('frontend.layout.app')
@section('title','Add Edit Shipping Address')
@section('content')
{{-- Main content  --}}
<div class="main-content mt-5">
   <div class="container">
     <div class="row">
        <h4>{{ $title }}</h4>
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
        <form  @if(empty($addressData)) action="{{ url('/add-edit-address') }}" @else action="{{ url('/add-edit-address/'.$addressData['id']) }}" @endif method="post">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" @if(!empty($addressData['name'])) value="{{$addressData['name']}}" @else value="{{ old('name') }}" @endif placeholder="Enter name">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" @if(!empty($addressData['email'])) value="{{$addressData['email']}}" @else value="{{ old('email') }}" @endif placeholder="Enter Email (optional)">
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" name="phone" id="phone" @if(!empty($addressData['phone'])) value="{{$addressData['phone']}}" @else value="{{ old('phone') }}" @endif placeholder="Enter Phone">
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" name="address" id="address" @if(!empty($addressData['address'])) value="{{$addressData['address']}}" @else value="{{ old('address') }}" @endif placeholder="Enter address">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
          <a href="{{ url('/checkout') }}" class="btn btn-danger">Go Back</a>
        </form>
     </div>
   </div>
 </div>
 @endsection
