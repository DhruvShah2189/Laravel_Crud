<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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

Route::redirect('/', 'login');

// Route::get('/', function () {
//     return view('auth.login');
// });

Auth::routes();

Route::get('password/reset',  [ForgotPasswordController::class,'index'])->name('forgotpassword');
Route::post('forgot_password', [ForgotPasswordController::class,'forgotPwd'])->name('forgot_password');
Route::get('resetPassword/{token}', [ForgotPasswordController::class, 'resetPasswordPage'])->name('resetpassword');
Route::post('changePassword', [ForgotPasswordController::class, 'resetPassword'])->name('changePassword');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::resource('category', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::get('category/delete/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/validate-category', [CategoryController::class, 'validateCategory']);
    Route::get('products/delete/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('products/show/{product}', [ProductController::class, 'show'])->name('products.show');

});
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
