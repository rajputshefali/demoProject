<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Product;
use Hash;
use Cookie;
use Session;

class AdminController extends Controller
{
    //front
    public function front()
    {
       return view("front");
    }
   
    //admin register
    
    public function adminRegister(){
        return view('adminRegister');
    }
    
    //save admin
    public function saveAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z]/u',
            'email' => 'required|email|unique:admins|email:rfc,dns',
            'password' => 'required|min:6|max:12|regex:/^\S*$/u',
            'confirmpassword' => 'required|same:password'
        ]);

        $admin = new Admin;
        $admin->name = $request['name'];
        $admin->email = $request['email'];
        $admin->password =bcrypt($request['password']);
        $res = $admin->save();
        if($res){
             return redirect('/admin/login')->with('success', 'you  have registered successfully');
            //  return redirect('/alogin');
        }else{
             return back()->with('fail', 'something went wrong');
        }
    }

    //admin Login
     //adminLogin
     public function adminlogin()
     {
         return view("adminLogin");
     }
 
     public function adminAuth(Request $request)
     {
         $request->validate([
             'email' => 'required|email|exists:admins',
             'password' => 'required'
         ]);
 
         $admin = Admin::where(['email'=> $request->email])->first();
         if($admin)
         {
          if(Hash::check($request->password, $admin->password))
          {
             $request->session()->put('adminId', $admin->id);
             Cookie::queue(Cookie::make('adminId', $admin->id));
            
         //  dd(session()->get('adminId'));
         return redirect('/dashboard')->with('success' ,'Successfully logged in');
 
        } else{
         return back()->with('fail' ,'Password mismatched.');
        }
        
       }
      else{
       return back()->with('fail' ,'Credentials mismatched.');
      }
     }

     //dashboard
     public function dashboard(){
        return view('dashboard');
     }

     //create-product
     public function createProductForm(){
        return view('createProductForm');
     }

     public function storeProducts(Request $request){
        $request->validate([
            'name' => 'required',
            'amount' => 'required|numeric',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $filename = null;

        if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $data['image']= $filename;
        }
        $product = new Product;
        $product->name = $request->name;
        $product->amount = $request->amount;
        $product->description = $request->description;
        $product->image = $filename;
        $product->save();

        // Redirect back or to a success page
        return redirect()->back()->with('success', 'Product created  successfully.');
     }

     //show all product

     public function showProduct(){
        $products = Product::all();
        return view('showProducts', compact('products'));
     }
   
    //product management
    public function productManage()
     {
         $products = Product::get();
         return view("productManagement", compact('products'));
     }
     //edit-user info
     public function editProduct($id)
     {
         $data = Product::where('id', $id)->first();
         return view("edit-product", compact('data'));
     }

     //update-user
     public function updateProduct(Request $request, $id)
     {
       
       
         $user = Product::find($id);
            $user->name = $request->input('name');
            $user->amount = $request->input('amount');
            $user->description = $request->input('description');
            $user->update();
            return redirect()->back()->with('update', 'Product Information is updated successfully');
     }

     //delete product
     public function productDelete($id)
        {
          $delete = Product::where('id', $id)->firstorfail()->delete();
      
          return redirect()->back()->with('productDeleted', 'The  Requested Product  is Deleted Successfully');   
   
        }
     public function logout()
     {
        // Auth::logout();
        Cookie::forget('adminId');
        if (session()->has('adminId')) 
         {
           session()->pull('adminId');
           
         }
        return redirect('/');
     }
}
