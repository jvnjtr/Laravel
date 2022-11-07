<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserregistrationController;
use App\Http\Controllers\UserverifyController;

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
    return view('login\login');
});
Route::get('/userlogin', function () {
    return view('login\login');
});
Auth::routes(['verify'=>true]);
Route::get('/registeruser', function () {
    return view('register\register');
});
Route::get('/index', function () {
    return view('project\dashboard');
});
Route::get('/excel', function () {
    return view('excel\excel');
});

Route::get('/dashboard', function () {
    return view('project\dashboard');
});
Route::group(['middleware' => 'usersession'], function () {
        Route::get('/studententryform', function () {
            return view('student\studententry');
          }); 
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//when user regissters
Route::post('/user_register',[UserregistrationController::class, 'register']);
//after successful registration redirect him to this route to send the verification notificaation
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth','verified'])->name('verification.notice');
//when user regissters
//login using email and password
Route::post('/user_login',[UserverifyController::class, 'userlogin']);