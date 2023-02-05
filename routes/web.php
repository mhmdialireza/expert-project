<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\SinglePageController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::get('login', 'loginPage')->name('login-page');
    Route::post('login', 'login')->name('login');
    Route::get('register', 'registerPage')->name('register-page');
    Route::post('register', 'register')->name('register');
    Route::middleware('auth')->get('logout', 'logout')->name('logout');
    Route::middleware('auth')->post('confirm-password', 'confirmPassword')->name('confirm-password');
});

Route::middleware('auth')->group(function () {

    Route::controller(SinglePageController::class)->group(function () {
        Route::get('', 'home')->name('home');
        Route::get('/profile', 'profile')->name('profile');
    });

    Route::prefix('folders')->controller(FolderController::class)->group(function () {
        Route::get('{folder}', 'show')->name('folder.show');
        Route::get('create/{type}', 'create')->name('folder.create');
        Route::post('store', 'store')->name('folder.store');
        Route::get('{folder}/edit', 'edit')->name('folder.edit');
        Route::put('{folder}', 'update')->name('folder.update');
        Route::delete('{folder}', 'delete')->name('folder.delete');
    });

    Route::prefix('todos')->controller(TodoController::class)->group(function () {
        Route::get('', 'index')->name('todo.index');
        Route::get('create', 'create')->name('todo.create');
        Route::post('store', 'store')->name('todo.store');
        Route::get('{todo}', 'show')->name('todo.show');
        Route::put('{todo}', 'update')->name('todo.update');
        Route::delete('{todo}', 'delete')->name('todo.delete');
        Route::get('change-status/{todo}', 'changeStatus')->name('todo.change-status');
    });

    Route::prefix('bookmarks')->controller(BookmarkController::class)->group(function () {
        Route::get('', 'index')->name('bookmark.index');
        Route::get('create', 'create')->name('bookmark.create');
        Route::post('store', 'store')->name('bookmark.store');
        Route::get('{bookmark}', 'show')->name('bookmark.show');
        Route::put('{bookmark}', 'update')->name('bookmark.update');
        Route::delete('{bookmark}', 'delete')->name('bookmark.delete');
    });

    Route::prefix('passwords')->controller(PasswordController::class)->group(function () {
        Route::get('', 'index')->name('password.index');
        Route::get('create', 'create')->name('password.create');
        Route::post('', 'store')->name('password.store');
        Route::get('{password}', 'show')->name('password.show');
        Route::put('{password}', 'update')->name('password.update');
        Route::delete('{password}', 'delete')->name('password.delete');
        Route::post('get', 'getPassword')->name('password.get-password');
    });

});

Route::fallback(function () {
    return view('pages.not-found');
});
