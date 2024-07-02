<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
 
Route::middleware(['guest'])->group(function() {
    Route::get('/', function () {
        return view('auth.login');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/editprofile', [ProfileController::class, 'editprofile'])->name('profile.editprofile');
    Route::put('/updateprofile', [ProfileController::class, 'updateprofile'])->name('profile.updateprofile');
    
    // Prensence
    Route::get('/presence', [PresenceController::class, 'create'])->name('presence.create')->middleware('role:owner|hrd|employee');
    Route::post('presence/store', [PresenceController::class, 'store'])->name('presence.store');
    
    // History
    Route::get('/history', [PresenceController::class, 'history'])->name('presence.history');
    Route::post('/gethistory', [PresenceController::class, 'getHistory'])->name('presence.get_history');
    
    // Edit Profile
    Route::get('/userregister', [RegisteredUserController::class, 'create'])->name('user_register');
    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    
});

require __DIR__.'/auth.php';
