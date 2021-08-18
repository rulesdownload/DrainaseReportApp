<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Livewire\KelolaPost;
use App\Http\Livewire\Action;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Frontend\ReportController;
use App\Http\Controllers\GoogleAuthController;

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
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

//laporan
Route::get('/laporan',[ReportController::class, 'render'])->middleware(['auth'])->name('laporan');
Route::get('/show',[ReportController::class,'view'])->middleware(['auth'])->name('show');
require __DIR__.'/auth.php';

//google sign in
Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
  })->name('google.redirect');

Route::get('/auth/google/callback', [GoogleAuthController::class,'RespondCallback'])->name('google.callback');

Route::group(['middleware' =>['auth']], function() {
Route::get('/dashboard',[HomeController::class,'render'])->name('dashboard');
});
Route::prefix('admin')->group(function () {
    // Route::get('/dashboard', function () {
    //     // Matches The "/admin/users" URL
    //     return view('admin.dashboard');
    // })->middleware(['admin:admin'])->name('dashboard');
   Route::get('/kelola',[AdminController::class, 'ShowPost'])->middleware(['admin:admin'])->name('posts');
   Route::get('/kelola/{id}',KelolaPost::class)->middleware(['admin:admin'])->name('kelola');
   Route::get('/action',[AdminController::class, 'Action'])->middleware(['admin:admin'])->name('action');

});
	// Route::resource('','');
		// Route::group (['middleware' => 'limitaccess'], function(){
		// 	Route::resource('dashboard', 'AdminController');
		// });
	
