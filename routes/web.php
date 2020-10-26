<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [App\Http\Controllers\admin::class, 'index']);
Route::get('/admin/exam_category', [App\Http\Controllers\admin::class, 'examCategory']);
Route::post('/admin/add_new_category', [App\Http\Controllers\admin::class, 'addNewCategory']);
Route::get('/admin/delete_category/{id}', [App\Http\Controllers\admin::class, 'deleteCategory']);
Route::get('/admin/get_category', [App\Http\Controllers\admin::class, 'getCategory']);
Route::post('/admin/edit_category', [App\Http\Controllers\admin::class, 'editCategory']);
Route::get('/admin/change_status', [App\Http\Controllers\admin::class, 'changeCategoryStatus']);
Route::get('/admin/manage_exam', [App\Http\Controllers\admin::class, 'manageExam']);
Route::post('/admin/add_new_exam', [App\Http\Controllers\admin::class, 'addExam']);
Route::get('/admin/change_exam_status', [App\Http\Controllers\admin::class, 'changeExamStatus']);
Route::get('/admin/delete_exam', [App\Http\Controllers\admin::class, 'deleteExam']);
Route::get('/admin/get_exam', [App\Http\Controllers\admin::class, 'getExam']);