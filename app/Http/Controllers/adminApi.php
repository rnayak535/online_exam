<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\app_category;
use App\Models\app_exam_master;
use App\Models\app_student;
use Validator;

class adminApi extends Controller
{
    public function getAllStudents($id=null){
        return $id?app_student::where('status', '1')->find($id):app_student::where('status', '1')->get();
    }

    public function addExamCategory(Request $request){
        $validator = Validator::make($request->all(), ['title'=>'required','exam_date'=>'required','categoryId'=>'required']);
        if($validator->passes()){
            $oExamCategory = new app_exam_master();
            $oExamCategory->title = $request->title;
            $oExamCategory->category = $request->categoryId;
            $oExamCategory->exam_date = $request->exam_date;
            $oExamCategory->status = 1;
            $result = $oExamCategory->save();
            if($result){
                return ["message"=>"Exam category added successfully."];
            }else{
                return ["message"=>"Oops! Operation failed."];
            }
        }else{
            return ['message'=>$validator->errors()->all()];
        }
       
    }
}
