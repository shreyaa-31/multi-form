<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Http\Requests\StepFourRequest;
use App\Http\Requests\StepOneRequest;
use App\Http\Requests\StepThreeRequest;
use App\Models\Category;
use App\Models\Skill;
use App\Models\User;
use App\Models\UserDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function stepOneForm(Request $request)
    {

        $user = $request->session()->get('user');
     
        
        return view('users.step-one', compact('user'));
    }

    public function storeStepOne(StepOneRequest $request)
    {
       
        $data = $request->all();

        $request->session()->forget('user');

        if (empty($request->session()->get('user'))) {

            $user = new User;
            
            $data['password'] = Hash::make($request->password);

            $user->fill($data);
            $request->session()->put('user', $user);
        } else {

            $user = $request->session()->get('user');
           
            $data['password'] = Hash::make($request->password);
            $user->fill($data);
            $request->session()->put('user', $user);
        }

        return response()->json(['status' =>true]);
    }


    public function stepTwoform(Request $request)
    {
        $user = $request->session()->get('user');

        return view('users.step-two', compact('user'));
    }

    public function storeStepTwo(Request $request)
    {
        $data = $request->all();

        if (empty($request->session()->get('user'))) {

            $user = new User;
            $user->fill($data);
            $user->session()->put('user', $user);
        } else {

            $user = $request->session()->get('user');
            $user->fill($data);

            $request->session()->put('user', $user);

            return response()->json(['status' =>true]);
        }
    }


    public function stepThreeform(Request $request)
    {
        $user = $request->session()->get('user');
        $image = $request->session()->get('image');
        $i1 = explode(',',$image['identification_doc']);
        $i2 = explode(',',$image['education_doc']);
        

        return view('users.step-three', compact('user','image','i1','i2'));
    }

    public function storeStepThree(StepThreeRequest $request)
    {
        $data = $request->all();

        if (empty($request->session()->get('user'))) {

            $user = new User;
            foreach ($request->identification_doc as $c) {
                $image1 = imageStore($c);
                $i[] = $image1;
            }
            $data['identification_doc'] = implode(',', $i);

            foreach ($request->education_doc as $c) {
                $image1 = imageStore($c);
                $e[] = $image1;
            }
            $data['education_doc'] = implode(',', $e);
            

            if (!empty($request->criminal_doc)) {
                foreach ($request->criminal_doc as $c) {
                    $image1 = imageStore($c);
                    $cd[] = $image1;
                }
                $data['criminal_doc'] = implode(',', $cd);
            }

            if (!empty($request->medical_doc)) {
                foreach ($request->medical_doc as $c) {
                    $image1 = imageStore($c);
                    $m[] = $image1;
                }
                $data['medical_doc'] = implode(',', $m);
            }

            $user->fill($data);
            $user->session()->put('user', $user);
        } else {

            $user = $request->session()->get('user');

            foreach ($request->identification_doc as $c) {
                $image1 = imageStore($c);
                $i[] = $image1;
            }
            $data['identification_doc'] = implode(',', $i);

            foreach ($request->education_doc as $c) {
                $image1 = imageStore($c);
                $e[] = $image1;
            }
            $data['education_doc'] = implode(',', $e);


            if (!empty($request->criminal_doc)) {
                foreach ($request->criminal_doc as $c) {
                    $image1 = imageStore($c);
                    $cd[] = $image1;
                }
                $data['criminal_doc'] = implode(',', $cd);
            }

            if (!empty($request->medical_doc)) {
                foreach ($request->medical_doc as $c) {
                    $image1 = imageStore($c);
                    $m[] = $image1;
                }
                $data['medical_doc'] = implode(',', $m);
            }
           
            $user->fill($data);
          
          
           
            $request->session()->put(['user'=>$user,'image'=>$data]);

            return response()->json(['status' =>true]);
        }
    }

    public function stepFourForm(Request $request)
    {
        $user = $request->session()->get('user');
        $image = $request->session()->get('image');
        // dd($image);
        $category = Category::select('id', 'category_name')->get();
        $skill = Skill::select('id', 'skill_name')->get();
        return view('users.step-four', compact('user', 'category', 'skill'));
    }

    public function storeStepFour(StepFourRequest $request)
    {
        $data = $request->all();

        if (empty($request->session()->get('user'))) {

            $user = new User;
            $user->fill($data);
            $user->session()->put('user', $user);
        } else {

            $user = $request->session()->get('user');
            $image = $request->session()->get('image');
           
           
            $i_image = explode(',',$image['identification_doc']);
            $e_image = explode(',',$image['education_doc']);
          
            $user['category_id'] = implode(',', $request->category_id);
            $user['skill_id'] = implode(',', $request->skill_id);
            $user->user_info = $request->user_info;
            
            // dd($user);
            $user->save();
           
            foreach($i_image as $i){
               
                UserDocument::insert([
                    'type' => "1",
                    'image' => $i,
                    'user_id' => $user->id
                ]);
            }

            foreach($e_image as $e){
                UserDocument::insert([
                    'type' => "4",
                    'image' => $e,
                    'user_id' => $user->id
                ]);
            }


            if(!empty($image['criminal_doc'])){
                $e_image = explode(',',$image['criminal_doc']);
                foreach($e_image as $e){
                    UserDocument::insert([
                        'type' => "3",
                        'image' => $e,
                        'user_id' => $user->id
                    ]);
                }
            }

            if(!empty($image['medical_doc'])){
                $m_image = explode(',',$image['medical_doc']);
                foreach($m_image as $m){
                    UserDocument::insert([
                        'type' => "3",
                        'image' => $m,
                        'user_id' => $user->id
                    ]);
                }
            }
            
            $request->session()->forget('user','image');

            return response()->json(['status' =>true,'message' => "You are successfully registered"]);
        }
    }
}
