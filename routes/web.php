<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DontHaveAccess;
use App\Http\Controllers\LibrarianDashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
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


Route::middleware(['guest'])->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'auth']);
    Route::resource("/register", RegisterController::class);
});

Route::get('/home', function () {
     return redirect('/dashboard');
});

// error route
Route::get('/you-dont-have-access', [DontHaveAccess::class, 'index'])->name('you-dont-have-access');

// auth route
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    // admin route
    Route::get('/admindashboard', [AdminDashboardController::class, 'index'])->middleware('userAccess:admin');
 
    // member route
    Route::get('/memberdashboard', [DashboardController::class, 'index'])->middleware('userAccess:member');

    // librarian route
    Route::get('/librariandashboard', [LibrarianDashboardController::class, 'index'])->middleware('userAccess:librarian');
});
