<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class admin extends Controller
{
   public function index(){
       
       return view('admin.dashboard');
   }

   public function examCategory(){
       return view('admin.examCateogry');
   }
}
