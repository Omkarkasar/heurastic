<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('studentform',[HomeController::class,'studentform'])->name('studentform');
//Student CRUD Operation Routes
Route::post('studentstore', [StudentController::class, 'studentstore'])->name('studentstore');
Route::get('studentget',[StudentController::class,'studentget'])->name('studentget');
Route::get('studentedit/{id}',[StudentController::class,'studentedit'])->name('studentedit');
Route::post('studentupdate/{id}', [StudentController::class, 'studentupdate'])->name('studentupdate');

Route::delete('studentdelete/{id}', [StudentController::class, 'studentdelete'])->name('studentdelete');
// Courses Crud
Route::get('courseform',[HomeController::class,'courseform'])->name('courseform');
Route::post('coursestore', [CourseController::class, 'coursestore'])->name('coursestore');
Route::get('courseget',[CourseController::class,'courseget'])->name('courseget');
Route::get('courseedit/{id}',[CourseController::class,'courseedit'])->name('courseedit');
Route::post('courseupdate/{id}', [CourseController::class, 'courseupdate'])->name('courseupdate');
Route::delete('coursedelete/{id}', [CourseController::class, 'coursedelete'])->name('coursedelete');

//Enrollment
Route::get('enrollmentform', [HomeController::class, 'enrollmentform'])->name('enrollmentform');
// Route::get('enrollmentget', [EnrollmentController::class, 'enrollmentget'])->name('enrollmentget');
Route::post('enrollmentstore', [EnrollmentController::class, 'enrollmentstore'])->name('enrollmentstore');
Route::get('enrollmentget',[EnrollmentController::class,'enrollmentget'])->name('enrollmentget');
//Teacher
Route::get('teacherform', [HomeController::class, 'teacherform'])->name('teacherform');
Route::post('teacherstore', [TeacherController::class, 'teacherstore'])->name('teacherstore');
Route::get('teacherget',[TeacherController::class,'teacherget'])->name('teacherget');
Route::get('teacheredit/{id}',[TeacherController::class,'teacheredit'])->name('teacheredit');
Route::post('teacherupdate/{id}', [TeacherController::class, 'teacherupdate'])->name('teacherupdate');
Route::delete('teacherdelete/{id}', [TeacherController::class, 'teacherdelete'])->name('teacherdelete');
//task
Route::get('taskform', [HomeController::class, 'taskform'])->name('taskform');
Route::post('taskstore', [TaskController::class, 'taskstore'])->name('taskstore');
