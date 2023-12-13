<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\StudentController;


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
Route::prefix('students')->group(function () {
    Route::get('/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/', [StudentController::class, 'store'])->name('students.store');
    Route::get('/views', [StudentController::class, 'index'])->name('students.index');
    Route::get('/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/{id}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/{id}', [StudentController::class, 'destroy'])->name('students.destroy');

});


Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/', [DashBoardController::class, 'index'])->name('admin.index')->middleware('auth','checklogin:class');
    Route::get('/master', [DashBoardController::class, 'index'])->name('admin.master');
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/add-category', [CategoryController::class, 'create'])->name('category.add');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
