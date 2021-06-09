<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use File;

class AdminController extends Controller
{  
	//login
    public function login(Request $request){
		if($request->isMethod('post')){
           $validatedData = $request->validate([
		        'email' => 'required|email',
		        'password' => 'required',
		    ]);

			if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])){
				return redirect('/admin/dashboard');
			}else{
				Session::flash('error-message','Invalid Email or Password');
				return redirect()->back();
			}
		}
		return view('backend.admin.login');
	}
   
	//dashboard
    public function dashboard(){
		Session::put('page','dashboard');
      return view('backend.dashboard.dashboard');
    }

	 // update admin Details
	 public function updateAdminDetails(Request $request){
		Session::put('page','update-admin-details');
		if($request->isMethod('post')){
			$data = $request->all();
            $user = Auth::guard('admin')->user()->image;

            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
            ];
            $customMessage = [
            	'name.required' => 'Name is required',
            	'name.regex' => 'Valid name is required',
            ];
            $this->validate($request,$rules,$customMessage);
            
            $image = $request->file('image');  
	        if(isset($image)){
                // create image name
	            $imageName = rand(111,99999).'-'.uniqid().'.'.$image->getClientOriginalExtension();
	            //delete old profile image
	            $deleteOldProfileImg = 'images/profile/'.$user;
	            if(file_exists($deleteOldProfileImg)){
	            	File::delete($deleteOldProfileImg);
	            }
	            //save image after resize
	            $profileImgPath = 'images/profile/'.$imageName;
	            Image::make($image)->resize(200,200)->save($profileImgPath);
	        }else{
	        	if(isset($user)){
	        		$imageName = Auth::guard('admin')->user()->image;
	        	}else{
	                $imageName = '';
	        	}
	            
	        } 

			Admin::where('email',Auth::guard('admin')->user()->email)->update(['name'=>$data['name'],'image'=>$imageName]);
			session::flash('success_message','Admin Details Successfully Updated');
			return redirect()->back();
		}
		return view('backend.admin.update_admin_details');
	}
   
	//check admin current password is correct or not
	public function checkCurrentPassword(Request $request){
		$data = $request->all();
		if(Hash::check($data['current_password'], Auth::guard('admin')->user()->password)){
			return 'true';
		}else{
			return 'false';
		}
	}

	// update admin password
	public function updateAdminPassword(Request $request){
		Session::put('page','update-admin-password');
		if($request->isMethod('post')){
			$data = $request->all();
			 $rules = [
		        'current_password' => 'required',
		        'new_password' => 'required',
		        'confirm_new_password' => 'required'
		    ];
		    $customMessage = [
              'current_password.required' => 'Current password is required',
              'new_password.required' => 'New password is required',
              'confirm_new_password.required' => 'Confirm new password is required'
            ];
            $this->validate($request,$rules,$customMessage);

		    if($data['new_password'] == $data['confirm_new_password']){
	    	Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_password'])]);
	    	session::flash('success_message','Password Successfully Updated');
	    	return redirect()->back();    
		    }else{
		    	session::flash('error_message','New && Confirm Password Not Match');
		    	return redirect()->back(); 
		    	}
			}
		return view('backend.admin.update_admin_password');
	  }

	//logout
	public function logout(){
		return redirect('/admin');
	}
}
