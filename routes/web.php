<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\permissioncontroller;
use App\Http\Controllers\rolecontroller;
use App\Http\Controllers\Articlecontroller;
use App\Http\Controllers\usercontroller;
use Illuminate\Support\Facades\Route;

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

    // Permission route 
    Route::get('/permissions', [permissioncontroller::class, 'index'])->name('permission.list');
    Route::get('/permissions/create', [permissioncontroller::class, 'create'])->name('permission.create');
    Route::post('/permissions', [permissioncontroller::class, 'store'])->name('permission.store');
    Route::get('/permissions/{id}/edit', [permissioncontroller::class, 'edit'])->name('permission.edit');
    Route::post('/permissions/{id}', [permissioncontroller::class, 'update'])->name('permission.update');
    Route::get('/permissions/{id}', [permissioncontroller::class, 'destroy'])->name('permission.destory');

    // Role route 
    Route::get('/roles',[rolecontroller::class,'index'])->name('role.index');
    Route::get('/roles/create',[rolecontroller::class,'create'])->name('role.create');
    Route::post('/roles',[rolecontroller::class,'store'])->name('role.store');
	Route::get('/roles/{id}/edit', [rolecontroller::class, 'edit'])->name('role.edit');
    Route::post('/roles/{id}', [rolecontroller::class, 'update'])->name('role.update');
    Route::get('/roles/{id}', [rolecontroller::class, 'destroy'])->name('role.destory');

	// Article route 
    Route::get('/articles',[Articlecontroller::class,'index'])->name('articles.index');
    Route::get('/articles/create',[Articlecontroller::class,'create'])->name('articles.create');
    Route::post('/articles',[Articlecontroller::class,'store'])->name('articles.store');
    Route::get('/articles/{id}/edit', [Articlecontroller::class, 'edit'])->name('articles.edit');
    Route::post('/articles/{id}', [Articlecontroller::class, 'update'])->name('articles.update');
    Route::get('/articles/{id}', [Articlecontroller::class, 'destroy'])->name('articles.destory');

    // user route 
    Route::get('/users',[usercontroller::class,'index'])->name('users.index');
    // Route::get('/articles/create',[Articlecontroller::class,'create'])->name('articles.create');
    // Route::post('/articles',[Articlecontroller::class,'store'])->name('articles.store');
    Route::get('/users/{id}/edit', [usercontroller::class, 'edit'])->name('users.edit');
    Route::post('/users/{id}', [usercontroller::class, 'update'])->name('users.update');
    // Route::get('/articles/{id}', [Articlecontroller::class, 'destroy'])->name('articles.destory');

	});

require __DIR__.'/auth.php';
