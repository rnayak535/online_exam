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
        $data=array();
        $data["category"] = app_category::orderBy('id','DESC')->get()->toArray();
        return view('admin.examCateogry', $data);
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

   public function deleteCategory($id){
       $category = app_category::where('id',$id)->get()->first();
       $category->delete();
       return redirect(url('admin/exam_category'));
   }

   public function getCategory(Request $request){
        $category = app_category::where('id',$request->categoryId)->get()->first();
        $data=array();
        $data["category"] =  $category;
        return view('admin.editCategoryAjax',$data);
   }

   public function editCategory(Request $request){

        $validator = Validator::make($request->all(), ['name'=>'required']);

        if($validator->passes()){
            $oCategory = app_category::where('id',$request->EditcategoryId)->get()->first();
            $oCategory->name = $request->name;
            $oCategory->update();
            $array = array('status'=>'success', 'message'=>'Category Updated successfully', 'reloadUrl'=>url('admin/exam_category'));
        }else{
            $array = array('status'=>'false', 'message'=>$validator->error()->all(), 'reloadUrl'=>url('admin/exam_category'));
        }
        echo json_encode($array);
   }
}
