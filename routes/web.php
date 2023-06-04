<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

Route::prefix('/admin')->name('admin.')->group(function() {

    Route::get('/', function(){
        return view('admin.index');
    })->name('index');

    Route::prefix('/users')->name('users.')->group(function() {

        Route::get('/', [UsersController::class, 'index'])->name('manage-user');

        Route::get('/add', function() {
            return view('admin.register');
        })->name('add');

        Route::post('/add', [UsersController::class, 'postAdd'])->name('post-add');

        Route::get('/profile/{id}', [UsersController::class, 'getPofile'])->name('profile');

        Route::get('/delete/{id}', [UsersController::class, 'delete'])->name('delete');

        Route::post('/update', [UsersController::class, 'postProfile'])->name('update-profile');
    });

    Route::get('/categories', function() {
        return view('admin.categories');
    })->name('categories');
});