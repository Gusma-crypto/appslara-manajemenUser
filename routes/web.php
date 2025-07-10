<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\SettingController;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//managemen user & module
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/superadmin/users', [UserManagementController::class, 'index'])->name('superadmin.users.index');
    Route::put('/superadmin/users/{id}/update-role', [UserManagementController::class, 'updateRole'])->name('superadmin.users.update-role');
    Route::put('/superadmin/users/{user}/toggle-block', [UserManagementController::class, 'toggleStatus'])->name('superadmin.users.toggle-block');
    Route::get('/users/create', [UserManagementController::class, 'create'])->name('superadmin.users.create');
    Route::post('users', [UserManagementController::class, 'store'])->name('superadmin.users.store');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//settings email
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/settings/email', [SettingController::class, 'editEmail'])->name('settings.email.edit');
    Route::post('/settings/email', [SettingController::class, 'updateEmail'])->name('settings.email.update');
});

require __DIR__.'/auth.php';
