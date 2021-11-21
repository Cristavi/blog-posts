<?php

use App\Http\Controllers\auth\Login_controller;
use App\Http\Controllers\auth\Register_controller;
use App\Http\Controllers\auth\User_controller;
use App\Http\Controllers\blog\Blog_controller;
use App\Http\Controllers\comment\Comment_controller;
use App\Http\Controllers\like\Like_controller;
use App\Http\Controllers\profile\UserProfile_controller;
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
//
//Route::get('/', function () {
//    return view('blogs.index');
//});
//


Route::get('/register', [Register_controller::class, 'index'])->name('register');
Route::post('/register', [Register_controller::class, 'store']);

Route::get('/login', [Login_controller::class, 'index'])->name('login');
Route::post('/login', [Login_controller::class, 'login']);
Route::post('/logout', [Login_controller::class, 'logout'])->name('logout');

Route::get('/', [Blog_controller::class, 'index'])->name('blogs');
Route::post('/blogs', [Blog_controller::class, 'store'])->name('addBlogs');
Route::delete('/blogs/{blogs}', [Blog_controller::class, 'destroy'])->name('deleteBlog');
Route::get('/blogs/{blogs}', [Blog_controller::class, 'single'])->name('single');
Route::put('/blogs/{blogs}', [Blog_controller::class, 'update'])->name('updatePost');

Route::post('/likes/{blogs}', [Like_controller::class, 'store'])->name('like');
Route::delete('/likes/{blogs}', [Like_controller::class, 'destroy'])->name('unlike');

Route::post('/comment/{blogs}', [Comment_controller::class, 'store'])->name('comment');
Route::delete('/comment/{comments:_id}', [Comment_controller::class, 'destroy'])->name('comment.destroy');
Route::get('/comment/{comments:_id}', [Comment_controller::class, 'single']);
Route::put('/comment/{comments:_id}', [Comment_controller::class, 'update']);

Route::get('/{user:username}', [UserProfile_controller::class, 'index'])->name('user.profile');

Route::get('/profile/edit/{user:username}', [User_controller::class, 'index'])->name('myProfile');
Route::put('/profile/edit/{user:_id}', [User_controller::class, 'update'])->name('myProfile.update');


