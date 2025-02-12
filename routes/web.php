<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
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
