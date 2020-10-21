<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\app_category;
use Validator;

class admin extends Controller
{
   public function index(){
       
       return view('admin.dashboard');
   }

   public function examCategory(){
       return view('admin.examCateogry');
   }

   public function addNewCategory(Request $request){
    
    $validator = Validator::make($request->all(), ['name'=>'required']);
        if($validator->passes()){
            $oCategory = new app_category();
            $oCategory->name = $request->name;
            $oCategory->status = 1;
            $oCategory->save();
            $array = array('status'=>'true', 'message'=>'success', 'reloadUrl'=>url('admin/exam_category'));
        }
        else{
            $array = array('status'=>'false', 'message'=>$validator->error()->all(), 'reloadUrl'=>url('admin/exam_category'));
        } 
    echo json_encode($array);
   }
}
