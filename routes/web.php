<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\Website;
use App\Http\Controllers\Team;
use App\Http\Controllers\Book;
use App\Http\Controllers\Topic;
use App\Http\Middleware\LoginAuth;
use Illuminate\Support\Facades\Route;

Route::get('/', [Website::class, 'login_page']);
Route::get('login', [Website::class, 'login_page']);
Route::get('register', [Website::class, 'signup_page']);

Route::post('login', [UserController::class, 'validate_login']);
Route::post('register', [UserController::class, 'register']);

Route::middleware([LoginAuth::class])->group(
    function () {
        Route::get('u/dashboard', [Website::class, 'dashboard']);
        Route::get('u/teams', [Website::class, 'view_teams']);
        Route::get('u/books', [Book::class, 'view_books']);
        Route::get('u/profile', [Website::class, 'view_profile']);
        Route::get('editor/new-book', [Book::class, 'new_book']);
        Route::get('u/editor/b/{book}', [Book::class, 'view_book']);
        Route::get('editor', [Website::class, 'view_editor']);
        Route::get('u/b/delete/{id}', [Book::class, 'delete_book']);
        Route::post('save/book', [Book::class, 'save_book_content']);

        Route::get('logout', [Website::class, 'logout']);

        // API 

        Route::post('api/team/kick', [Team::class, 'kick']);
        Route::post('api/topic/take', [Topic::class, 'take']);
        Route::post('api/book/show', [Book::class, 'show']);
        Route::post('api/book/update', [Book::class, 'update']);
        Route::post('api/book/forfeit', [Book::class, 'forfeit']);
        Route::post('api/book/complete', [Book::class, 'complete']);

        Route::post('u/topic/create', [Topic::class, 'create']);
        Route::post('api/topic/forfeit', [Topic::class, 'forfeit']);
        Route::post('api/topic/complete', [Topic::class, 'complete']);

        Route::post('u/team/create', [Team::class, 'create']);
        Route::post('u/team/join', [Team::class, 'join']);
        Route::get('u/team/request/accept/{team_id}/{user_id}', [Team::class, 'accept_request']);
        Route::get('u/team/request/reject/{team_id}/{user_id}', [Team::class, 'reject_request']);
        Route::get('u/team/{name}', [Team::class, 'details']);
    }
);

    
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
