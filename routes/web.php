<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Livewire\KelolaPost;
use App\Http\Livewire\Action;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Frontend\ReportController;

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

Route::group(['middleware' =>['auth']], function() {
	route::get('/dashboard',[HomeController::class,'render'])->name('dashboard');
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
	
