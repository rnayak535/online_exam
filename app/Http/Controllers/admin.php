<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\app_category;
use App\Models\app_exam_master;
use App\Models\app_student;
use Illuminate\Support\Facades\Hash;
use Validator;

class admin extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }
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
            $array = array('status'=>'false', 'message'=>$validator->errors()->all(), 'reloadUrl'=>url('admin/exam_category'));
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
            $array = array('status'=>'true', 'message'=>'Category Updated successfully', 'reloadUrl'=>url('admin/exam_category'));
        }else{
            $array = array('status'=>'false', 'message'=>$validator->error()->all(), 'reloadUrl'=>url('admin/exam_category'));
        }
        echo json_encode($array);
   }

   public function changeCategoryStatus(Request $request){
        $oCategory = app_category::where('id', $request->categoryId)->get()->first();
        if($oCategory->status == '1'){
            $status = 0;
        }else{
            $status = 1;
        }
        $oCategory->status = $status;
        $oCategory->update();
   }

   public function manageExam(){
       $oCategory = app_category::orderBY('id', 'DESC')->where('status', '1')->get()->toArray();
       $oApp_exam_master = app_exam_master::select('app_exam_masters.*','app_categories.name as cat_name')->join('app_categories','app_exam_masters.category','=','app_categories.id')->orderBY('id', 'DESC')->get()->toArray();
       $data["category"] = $oCategory;
       $data["exams"] = $oApp_exam_master;
       return view('admin.manageExam', $data);
   }

   public function addExam(Request $request){
        $validator = Validator::make($request->all(), ['title'=>'required','exam_date'=>'required','categoryId'=>'required']);
        if($validator->passes()){
            $oExam = new app_exam_master();
            $oExam->title = $request->title;
            $oExam->exam_date = $request->exam_date;
            $oExam->category = $request->categoryId;
            $oExam->status = 1;
            $oExam->save();
            $array = array('status'=>'true', 'message'=>'Exam added successfully.', 'reloadUrl'=>url('admin/manage_exam'));
        }else{
            $array = array('status'=>'false', 'message'=>$validator->errors()->all(), 'reloadUrl'=>url('admin/manage_exam'));
        }
        echo json_encode($array);
   }

   public function changeExamStatus(Request $request){
        $oApp_exam_master = app_exam_master::where('id', $request->examId)->get()->first();
        if($oApp_exam_master->status == '1'){
            $status = 0;
        }else{
            $status = 1;
        }
        $oApp_exam_master->status = $status;
        $oApp_exam_master->update();
   }

   public function deleteExam(Request $request){
        $oApp_exam_master = app_exam_master::where('id', $request->examId)->get()->first();
        $oApp_exam_master->delete();
   }

//    Edit exam modal
   public function getExam(Request $request){
        $exams = app_exam_master::where('id', $request->examId)->get()->first();
        $data["exams"] = $exams;
        $oCategory = app_category::orderBY('id', 'DESC')->where('status', '1')->get()->toArray();
        $data["category"] = $oCategory;
        return view('admin.examAjax', $data);
   }

   public function editExam(Request $request){
        $validator = Validator::make($request->all(), ['title'=>'required','exam_date'=>'required','categoryId'=>'required']);
        if($validator->passes()){
            $oApp_exam_master = app_exam_master::where('id', $request->examId)->get()->first();
            $oApp_exam_master->title = $request->title;
            $oApp_exam_master->exam_date = $request->exam_date;
            $oApp_exam_master->category = $request->categoryId;
            $oApp_exam_master->update();
            $array = array('status'=>'true', 'message'=>'Exam updated successfully.', 'reloadUrl'=>url('admin/manage_exam'));
        }else{
            $array = array('status'=>'false', 'message'=>$validator->errors()->all(), 'reloadUrl'=>url('admin/manage_exam'));
        }
        echo json_encode($array);
   }

//    Manage student section
   public function manageStudents(){
        $oApp_exam_master = app_exam_master::where('status', '1')->get()->toArray();
        $data["exams"] = $oApp_exam_master;
        $data["studentlist"] = app_student::select(['app_students.*','app_exam_masters.title as exam_name','app_exam_masters.exam_date'])->join('app_exam_masters','app_students.exam','=','app_exam_masters.id')->orderBy('id', 'DESC')->get()->toArray();
        return view('admin.manageStudent', $data);
   }

   public function addNewStudent(Request $request){
       $validator = Validator::make($request->all(), ['name'=>'required','email'=>'required','mobile_no'=>'required','dob'=>'required','exam'=>'required','password'=>'required']);
       if($validator->passes()){
           $oapp_student = new app_student();
           $oapp_student->name = $request->name;
           $oapp_student->email = $request->email;
           $oapp_student->mobile_no = $request->mobile_no;
           $oapp_student->dob = $request->dob;
           $oapp_student->exam = $request->exam;
           $oapp_student->password = Hash::make($request->password);
           $oapp_student->status = '1';
           $oapp_student->save();
           $array = array('status'=>'true', 'message'=>'Student added successfully', 'reloadUrl'=>url('admin/manage_students'));
       }else{
           $array = array('status'=>'false', 'message'=>$validator->errors()->all(), 'reloadUrl'=>url('admin/manage_students'));
       }
       echo json_encode($array);
   }

   public function deleteStudent(Request $request){
        $oapp_student = app_student::where('id', $request->recordId)->get()->first();
        if($oapp_student->status == '1'){
            $status = 0;
        }else{
            $status = 1;
        }
        $oapp_student->status = $status;
        $oapp_student->delete();
        $array = array('status'=>'true', 'message'=>'Student deleted successfully.', 'reloadUrl'=>url('admin/manage_students'));
        echo json_encode($array);
   }

   public function getStudent(Request $request){

        $oApp_exam_master = app_exam_master::where('status', '1')->get()->toArray();
        $data["exams"] = $oApp_exam_master;
        $oapp_student = app_student::where('id', $request->studentId)->get()->first();
        $data["student"] = $oapp_student;
        return view('admin.getStudentAjax', $data);
   }

   public function changeStudentStatus(Request $request){
        $oapp_student = app_student::where('id', $request->studentId)->get()->first();
        if($oapp_student->status == '1'){
            $status = 0;
        }else{
            $status = 1;
        }
        $oapp_student->status = $status;
        $oapp_student->update();
   }

   public function editStudent(Request $request){
        $validator = Validator::make($request->all(), ['name'=>'required','email'=>'required','mobile_no'=>'required','dob'=>'required','exam'=>'required']);
        if($validator->passes()){
            $oapp_student = app_student::where('id', $request->studentId)->get()->first();
            $oapp_student->name = $request->name;
            $oapp_student->email = $request->email;
            $oapp_student->mobile_no = $request->mobile_no;
            $oapp_student->dob = $request->dob;
            $oapp_student->exam = $request->exam;
            if(!empty(trim($request->password))){
                $oapp_student->password = Hash::make($request->password);
            }
            $oapp_student->update();
            $array = array('status'=>'true', 'message'=>'Student information updated successfully', 'reloadUrl'=>url('admin/manage_students')); 
        }else{
            $array = array('status'=>'false', 'message'=>$validator->errors()->all(), 'reloadUrl'=>url('admin/manage_students'));
        }
        echo json_encode($array);
   }
}