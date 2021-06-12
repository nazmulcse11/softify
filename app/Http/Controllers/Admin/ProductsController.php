<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Intervention\Image\Facades\Image;
use Session;
use File;

class ProductsController extends Controller
{
    public function products(){
        Session::put('page','products');
    	$products = Product::get();
    	// $products = json_encode(json_decode($products));
    	// echo "<pre>";print_r($products);
    	return view('backend.products.products',compact('products'));
    }

    public function addEditProduct(Request $request, $id=null){
    	if($id==''){
    		$title = 'Add Product';
         $productdata = array();
    		$product = new Product();
    		$message = 'Product Successfully Added';
    	}else{
    		$title = 'Edit Product';
    		$productdata = Product::find($id);
    		$productdata = json_decode(json_encode($productdata),true);
    		$product = Product::find($id);
    		$message = 'Product Successfully Updated';
    	}

    	if($request->isMethod('post')){
    		$data = $request->all();

    		$rules = [
    			'product_code' => 'required|regex:/^[\w-]*$/',
    			'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
    			'product_color' => 'required|regex:/^[\pL\s\-]+$/u',
    			'product_price' => 'required|numeric',
    			'product_stock' => 'required|numeric',
    		];
    		$customMessage = [
    			'product_code.required' => 'Product code is required',
    			'product_code.regex' => 'Valid product code is required',
    			'product_name.required' => 'Product name is required',
    			'product_name.regex' => 'Valid product name is required',
    			'product_color.required' => 'Product color is required',
    			'product_color.regex' => 'Valid product color is required',
    			'product_price.required' => 'Product price is required',
    			'product_price.numeric' => 'Valid product price is required',
				'product_stock.required' => 'Product stock is required',
    			'product_stock.numeric' => 'Valid product stock is required',
    		];

    		$this->validate($request,$rules,$customMessage);
             
            $image = $request->file('product_image');
            if(isset($image)){
            //delete old image from products directory while edit product
            $deleteOldImg =  'images/products/'.$product->product_image;
            if(file_exists($deleteOldImg)){
               File::delete($deleteOldImg);
            }  	
            //create image name 	
            $imageName = rand(99,99999).'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $ImgPath  = 'images/products/'.$imageName;
            //save image after resize
            Image::make($image)->resize(1000,1000)->save($ImgPath); //w:1000 h:1000
            }else{ 
                   if(isset($product->product_image)){
                      $imageName = $product->product_image;
	                }else{
	                    $imageName = '';
	                 }
                }  

    		 $product->product_code = $data['product_code'];
    		 $product->product_name = $data['product_name'];
    		 $product->product_color = $data['product_color'];
    		 $product->product_price = $data['product_price'];
    		 $product->product_stock = $data['product_stock'];
    		 $product->product_image = $imageName;
    		 $product->save();

             Session::flash('success_message',$message);
    		 return redirect('admin/products');
    	}
    	// echo "<pre>";print_r($categories);die;
    	return view('backend.products.add_edit_product',compact('title','productdata'));
    }

    public function deleteProduct($id){
        $deleteProduct = Product::find($id);
        //delete product image from product directory
        $ImgPath =  'images/products/'.$deleteProduct->product_image;
        if(file_exists($ImgPath)){
           File::delete($ImgPath);
       }

        $deleteProduct->delete();
        session::flash('success_message','Product Successfully Deleted');
        return redirect()->back();
   }
}
