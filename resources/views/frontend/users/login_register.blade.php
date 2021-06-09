@extends('frontend.layout.app')
@section('title','Login Register')
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
      @if(Session::has('success_message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('success_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div>
		  @endif
        {{-- User Register  --}}
        <div class="col-md-5">
         <h4>User Register</h4>
         <form id="registerForm" action="{{ url('/user-register') }}" method="post">
          @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Name">
            </div>
            <div class="mb-3">
               <label for="email" class="form-label">Email</label>
               <input type="text" class="form-control" name="email" id="email" placeholder="Enter Your Email">
             </div>
             <div class="mb-3">
               <label for="password" class="form-label">Password</label>
               <input type="text" class="form-control" name="password" id="password" placeholder="Enter Your Password">
             </div>
             <div class="mb-3">
               <label for="confirm_password" class="form-label">Confirm Password</label>
               <input type="text" class="form-control" name="password_confirmation" id="confirm_password" placeholder="Enter Your Password">
             </div>
            <button type="submit" class="btn btn-primary">Register</button>
          </form>
        </div>

        <div class="col-md-2"></div>

        {{-- User Login  --}}
        <div class="col-md-5">
         <h4>User Login</h4>
         <form id="loginForm" action="{{ url('/user-login') }}" method="post">
            @csrf
            <div class="mb-3">
               <label for="email" class="form-label">Email</label>
               <input type="text" class="form-control" name="email" id="email" placeholder="Enter Your Email">
             </div>
             <div class="mb-3">
               <label for="password" class="form-label">Password</label>
               <input type="text" class="form-control" name="password" id="password" placeholder="Enter Your Password">
             </div>
            <button type="submit" class="btn btn-primary">Sign In</button> &nbsp;&nbsp;
            <a href="javascript:void(0)">Forgot password</a> <br> <br>

            Sign in With:&nbsp;&nbsp;
            <a href="{{ url('/auth/facebook') }}">Facebook</a> &nbsp;&nbsp;
            <a href="{{ url('/auth/google') }}">Google</a>
          </form>
        </div>
     </div>
   </div>
 </div>
 @endsection
