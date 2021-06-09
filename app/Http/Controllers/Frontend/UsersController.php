<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
  // Login register page
  public function loginRegister(){
      return view('frontend.users.login_register');
  }

  //Check email already exists or not while register
  public function checkEmail(Request $request){
    $data = $request->all();
    //check if email already exists
    $checkEmail = User::where('email',$data['email'])->count();
    if($checkEmail > 0 ){
      return "false";
    }else{
      return "true";
    }
  }

    //Register a user
    public function registerUser(Request $request){
    if($request->isMethod('post')){
      Session::forget('success_message');
      Session::forget('error_message');
      $data = $request->all();

      $validatedData = $request->validate([
          'name'=>'required',
          'email'=>'required|email',
          'password'=>'required|confirmed',
      ]);

      $user = new User();
      $user->name = $data['name'];
      $user->email = $data['email'];
      $user->password = Hash::make($data['password']);
      $user->save();

      //Send confirmation email
      $email = $data['email'];
      $messageData = [
        'email' => $data['email'],
        'name' => $data['name'],
        'code' => base64_encode($data['email'])
      ];
      Mail::send('emails.confirmation',$messageData,function($message) use($email){
        $message->to($email)->subject('Confirm your ecommerce account');
      });

      //redirect back with success message
      $message = 'Please confirm your email to active your account';
      Session::put('success_message',$message);
      return redirect()->back();
    }
  }

  //Confirm user account from mail
  public function confirmAccount($email){
    Session::forget('success_message');
    Session::forget('error_message');
    $email = base64_decode($email);
    $userCount = User::where('email',$email)->count();
    if($userCount > 0){
      // check user email is alerady activated or not
      $userDetails = User::where('email',$email)->first();
      if($userDetails->status == 1){
        $message = 'Your email account is already activated. Please login';
        Session::put('error_message',$message);
        return redirect('login-register');
      }else{
        User::where('email',$email)->update(['status'=>1]);
        //Send register sms
        // $mobile =  $userDetails['mobile'];
        // $message = "Test SMS From Using API" ;
        // Sms::sendSms($mobile, $message);


        //Send register email
        $messageData = ['name'=>$userDetails['name'],'email'=>$email];
        Mail::send('emails.register',$messageData,function($message) use($email){
          $message->to($email)->subject('Welcome to Ecommerce BD');
        });    

        $message = 'Your email account is activated. You can login now';
        Session::put('success_message',$message); 
        return redirect('login-register');
      }
    }
  }

  //Login user
  public function userLogin(Request $request){
      if($request->isMethod('post')){
        Session::forget('success_message');
        Session::forget('error_message');
        $data = $request->all();
        if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
            return redirect('cart');
            }else{
            Session::put('error_message','Invalid email or password');
            return redirect()->back();
        }
      }
    }

  //Logout user
  public function userLogout(){
    Auth::logout();
    return redirect('/');
  }

  //Login with socialite

  //Login with google
  public function redirectToGoogle(){
    return Socialite::driver('google')->redirect();
  }
  
  public function handleGoogleCallback(){
      $user = Socialite::driver('google')->stateless()->user();
      $finduser = User::where('google_id', $user->id)->first();

      if($finduser){
          Auth::login($finduser);
          return redirect('/cart');

      }else{
          $newUser = new User();
          $newUser->name      = $user->name;
          $newUser->email     = $user->email;
          $newUser->google_id = $user->id;
          $newUser->password  = bcrypt('12345678');
          $newUser->status = 1;
          $newUser->save();
          Auth::login($newUser);
          return redirect('/cart');
      }
    }

    //Login with facebook
    public function redirectToFacebook() {
      return Socialite::driver('facebook')->redirect();
  }
  
  public function handleFacebookCallback(){
    $user = Socialite::driver('facebook')->stateless()->user();
    $finduser = User::where('facebook_id', $user->id)->first();

    if($finduser){
        Auth::login($finduser);
        return redirect('/cart');

    }else{
        $newUser = new User();
        $newUser->name      = $user->name;
        $newUser->email     = $user->email;
        $newUser->password  = bcrypt('12345678');
        $newUser->facebook_id = $user->id;
        $newUser->status = 1;
        $newUser->save();
        Auth::login($newUser);
        return redirect('/cart');
    }
  }

  //User profile page
  // public function userProfile(){
  //   return view('frontend.users.user_profile');
  // }
  
}
