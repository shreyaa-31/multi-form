<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;
use App\Http\Requests\SkillRequest;
use App\DataTables\SkillDataTable;

class SkillController extends Controller
{
    public function index(SkillDataTable $datatable){
        return $datatable->render('admin.skills.index');
    }

    public function store(SkillRequest $request){
        $skill = new Skill;
        $skill->skill_name = $request->skill_name;
        $skill->save();

        if(!empty($skill)){
            return response()->json(['status' => true, 'message' => 'Skill Added Successfully']);
        }else{
            return response()->json(['status' => false, 'message' => "Something Went Wrong"]);
        }
    }
    
    public function edit(Request $request){

        $skill = Skill::find($request->id);

        if(!empty($skill)){
            return response()->json(['status' =>true, 'data' => $skill]);
        }else{
            return response()->json(['status'=>true,'message'=> 'Data Not Found']);
        }
    }

    public function update(SkillRequest $request){
        $skill = Skill::find($request->id);
        $skill->skill_name = $request->skill_name;
        $skill->save();

        if(!empty($skill)){
            return response()->json(['status' => true, 'message' => 'Skill Updated Successfully']);
        }else{
            return response()->json(['status' => false, 'message' => "Something Went Wrong"]);
        }
    }

    public function delete(Request $request){
        $skill = Skill::find($request->id);
        if(!empty($skill)){
            $skill->delete();
            return response()->json(['status'=>true,'message'=> 'Skill Deleted']);
        }else{
            return response()->json(['status'=>true,'message'=> 'Something went wrong']);

        }
    }
}
