<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('admin', function () {
        return view('admin.dashboard');
    });

    Route::get('admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('admin/category', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('admin/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('admin/category', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('admin/category/{category}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::patch('admin/category/{category}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('admin/category/{category}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

    Route::get('admin/post', [PostController::class, 'index'])->name('admin.post.index');
    Route::get('admin/post/create', [PostController::class, 'create'])->name('admin.post.create');
    Route::post('admin/post', [PostController::class, 'store'])->name('admin.post.store');
    Route::get('admin/post/{post}/edit', [PostController::class, 'edit'])->name('admin.post.edit');
    Route::patch('admin/post/{post}', [PostController::class, 'update'])->name('admin.post.update');
    Route::delete('admin/post/{post}', [PostController::class, 'destroy'])->name('admin.post.destroy');
});

require __DIR__.'/auth.php';
