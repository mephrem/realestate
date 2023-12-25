<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ProfileController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//admin middleware
Route::middleware(['auth','role:admin'])->group(function(){
    Route::controller(AdminController::class)->group(function(){
        Route::get('admin/dashboard', 'adminDashboard')->name('admin.dashboard');
        Route::get('admin/profile', 'adminProfile')->name('admin.profile');
        Route::get('admin/logout', 'adminLogout')->name('admin.logout');
        Route::get('admin/chart', 'chart')->name('admin.chart');
        Route::post('admin/profile/store', 'adminProfileStore')->name('admin.profile_store');
        Route::get('admin/change/password', 'adminChangePassword')->name('admin.change_password');
        Route::post('admin/change/store', 'adminChangePasswordStore')->name('admin.change_password_store');
    });


});
Route::get('admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');


// agent middleware
Route::middleware(['auth','role:agent'])->group(function(){
    Route::get('agent/dashboard', [AgentController::class, 'agentDashboard'])->name('agent.dashboard');
});
