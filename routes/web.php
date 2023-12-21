<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CanBoController;



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

Route::get('/profile', [LoginController::class, 'profile'])->name('auth.profile');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/cong-nhan-details', [CanBoController::class, 'getCongNhanDetails']);
Route::get('/ky', [CanBoController::class, 'getKySu']);
Route::get('/nhan-vien', [CanBoController::class, 'getNhanVien']);


Route::group(['middleware' => 'checksession'], function () {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
});

Route::prefix('admin')->group(function () {
    Route::get('/', [DashBoardController::class, 'index'])->name('admin.index')->middleware('auth','checklogin:class');
    Route::get('/master', [DashBoardController::class, 'index'])->name('admin.master');
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/add-category', [CategoryController::class, 'create'])->name('category.add');
    Route::get('/sessions', [LoginController::class, 'getSessions']);
    Route::get('/show-cookie-form', [LoginController::class, 'showCookieBySessionId']);
    Route::post('/get-cookie-by-session-id', [LoginController::class,'getCookieBySessionId'])->name('index');

});




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
