<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\CategoryDataTable;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(CategoryDataTable $datatable){
        return $datatable->render('admin.categories.index');
    }

    public function store(CategoryRequest $request){
        $category = new Category;
        $category->category_name = $request->category_name;
        $category->save();

        if(!empty($category)){
            return response()->json(['status' => true, 'message' => 'Category Added Successfully']);
        }else{
            return response()->json(['status' => false, 'message' => "Something Went Wrong"]);
        }
    }
    
    public function edit(Request $request){

        $category = Category::find($request->id);

        if(!empty($category)){
            return response()->json(['status' =>true, 'data' => $category]);
        }else{
            return response()->json(['status'=>true,'message'=> 'Data Not Found']);
        }
    }

    public function update(CategoryRequest $request){
        $category = Category::find($request->id);
        $category->category_name = $request->category_name;
        $category->save();

        if(!empty($category)){
            return response()->json(['status' => true, 'message' => 'Category Updated Successfully']);
        }else{
            return response()->json(['status' => false, 'message' => "Something Went Wrong"]);
        }
    }

    public function delete(Request $request){
        $doctor = Category::find($request->id);
        if(!empty($doctor)){
            $doctor->delete();
            return response()->json(['status'=>true,'message'=> 'Category Deleted']);
        }else{
            return response()->json(['status'=>true,'message'=> 'Something went wrong']);

        }
    }
}
