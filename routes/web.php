<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TuController;
use App\Http\Controllers\ThemNganController;
use App\Http\Controllers\ThueTuController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PhanloaiNganController;



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
Route::get('/profile', [LoginController::class, 'profile'])->name('auth.profile');
Route::get('/login', [LoginController::class, 'login']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
// Route::post('/login', function () {
//     dd(87989);
// })->name('loginweb');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');


Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->middleware(['auth', 'checklogin:class'])->group(function () {
    Route::get('/', [ThueTuController::class, 'indexTu'])->name('admin.index');
    Route::get('/master', [DashBoardController::class, 'index'])->name('admin.master');
    Route::get('/thue-tu', [ThueTuController::class, 'thueTu'])->name('category.thue_tu');
    Route::get('/event', [EventController::class, 'index'])->name('category.event');
//    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/add-tu', [TuController::class, 'create'])->name('category.add_tu');
    Route::post('/add-tu', [TuController::class, 'store']);
    Route::get('/add-ngan', [ThemNganController::class, 'index'])->name('category.add_ngan');
    Route::post('/add-ngan', [ThemNganController::class, 'store']);
    Route::get('/thuetu', [ThueTuController::class, 'index'])->name('thuetu.store');
    Route::post('/thuetu', [ThueTuController::class, 'store']);
    Route::post('/thuetu/{id}/tratu', [ThueTuController::class, 'tratu'])->name('thuetu.tratu');
    Route::resource('ngan', ThemNganController::class);
    Route::get('/phanloai-ngan', [PhanloaiNganController::class, 'index'])->name('phanloai_ngan.index');
    Route::post('/phanloai-ngan', [PhanloaiNganController::class, 'store'])->name('phanloai_ngan.store');

    Route::get('/category-all', [TuController::class, 'index'])->name('category.index');
    Route::get('/category/{phanLoai}/edit', [TuController::class, 'edit'])->name('category.edit_tu');
    Route::put('/category/{phanLoai}', [TuController::class, 'update'])->name('category.update_tu');
    Route::delete('/category/{phanLoai}', [TuController::class, 'destroy'])->name('category.delete_tu');

    Route::get('/category-phan-loai-ngan', [PhanloaiNganController::class, 'create'])->name('category.index.phanloai');
    Route::get('/category-phan-loai-ngan/{id}/edit', [PhanloaiNganController::class, 'edit'])->name('category.edit.phanloai');
    Route::put('/category-phan-loai-ngan/{id}', [PhanloaiNganController::class, 'update'])->name('category.update_phan_loai_ngan');
    Route::delete('/category-phan-loai-ngan/{id}', [PhanloaiNganController::class, 'destroy'])->name('category.delete_phan_loai_ngan');

    Route::get('/category-ngan', [ThemNganController::class, 'create'])->name('category.index_ngan');
    Route::get('/category-ngan/{id}/edit', [ThemNganController::class, 'edit'])->name('category.edit_ngan');
    Route::put('/category-ngan/{id}/', [ThemNganController::class, 'update'])->name('category.update_ngan');
    Route::delete('/category-ngan/{id}/', [ThemNganController::class, 'destroy'])->name('category.delete_ngan');
});

Route::get('/lay-danh-sach-ngan', [ThueTuController::class, 'layDanhSachNgan']);
Route::get('/lay-ten-tu/{id}', [PhanloaiNganController::class, 'getTenTu'])->name('lay-ten-tu');
Route::post('/get-phanloai', [ThemNganController::class, 'getPhanLoai'])->name('get.phanloai');






Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
