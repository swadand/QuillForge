<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Website;
use Illuminate\Support\Facades\Route;

Route::get('/', [Website::class, 'login_page']);
Route::get('/login', [Website::class, 'login_page']);
Route::get('/register', [Website::class, 'signup_page']);

Route::get('/u/dashboard', [Website::class, 'dashboard']);
Route::get('/u/teams', [Website::class, 'view_teams']);
Route::get('/u/profile', [Website::class, 'view_profile']);

Route::get('/u/logout', [Website::class, 'logout']);
    
/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

/* Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
 */
//require __DIR__.'/auth.php';
