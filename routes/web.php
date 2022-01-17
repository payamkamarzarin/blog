<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Home\HomeController;
use Illuminate\Support\Facades\Hash;
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
Route::prefix('admin')->group(function(){
    Route::post('/CreatePost',[BlogController::class,'post_blog'])->name('postblog');
    Route::get('/CreatePost',[BlogController::class,'show'])->name('show');
});
Route::get('/home', [HomeController::class, 'index'])->name('home');
