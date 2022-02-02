<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showForm(){
        
        return view('users.step-one');
    }

    public function storeStepOne(Request $request){

        $validatedData = $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'string', 'numeric', 'digits:10', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required'],
            'zipcode' => ['required'],
        ]);
  
        if(empty($request->session()->get('user'))){
            $user = new User();
            $user->create($validatedData);
            dd($user);
            $request->session()->put('user', $user);
        }else{
            $user = $request->session()->get('user');
            $user->fill($validatedData);
            $request->session()->put('user', $user);
        }
  
        return redirect()->route('stepTwoForm');
    }

    
    public function stepTwoform(Request $request){
        $user = $request->session()->get('user');
        dd($user);
        return view('users.step-two',compact('user'));
    } 

    public function storeStepTwo(Request $request){

        $validatedData = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'website' => ['required','url'],
            'zipcode' => ['required'],
        ]);

        if(empty($request->session()->get('product'))){
            $product = new User();
            $product->fill($validatedData);
            $request->session()->put('product', $product);
        }else{
            $product = $request->session()->get('product');
            $product->fill($validatedData);
            $request->session()->put('product', $product);

            return view('users.step-three');
        }
    }
}
