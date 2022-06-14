<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('layouts.layout');
})->name('home');
Route::prefix('sections')->group(function (){
    Route::get('/all',[\App\Http\Controllers\SectionController::class,'index'])->name('sections');
    Route::get('/create',[\App\Http\Controllers\SectionController::class,'create'])->name('section.create');
    Route::get('/{id}/edit',[\App\Http\Controllers\SectionController::class,'edit'])->name('section.edit');
    Route::put('/update',[\App\Http\Controllers\SectionController::class,'update'])->name('section.update');
    Route::post('/store',[\App\Http\Controllers\SectionController::class,'store'])->name('section.store');
    Route::delete('/delete',[\App\Http\Controllers\SectionController::class,'destroy'])->name('section.delete');

});
Route::prefix('posts')->group(function () {
    Route::get('/all',[\App\Http\Controllers\PostController::class,'index'])->name('posts');
    Route::post('/post/show', [\App\Http\Controllers\PostController::class, 'show'])->name('post.show');
    Route::get('/post/create', [\App\Http\Controllers\PostController::class, 'create'])->name('post.create');
    Route::post('/post/store', [\App\Http\Controllers\PostController::class, 'store'])->name('post.store');
    Route::post('/update',[\App\Http\Controllers\PostController::class,'update'])->name('post.update');
    Route::delete('/delete',[\App\Http\Controllers\PostController::class,'destroy'])->name('post.delete');


});
Route::prefix('pen')->group(function () {
    Route::get('/all',[\App\Http\Controllers\PenController::class,'index'])->name('pens');
    Route::post('/pen/show', [\App\Http\Controllers\PenController::class, 'show'])->name('pen.show');
    Route::get('/pen/create', [\App\Http\Controllers\PenController::class, 'create'])->name('pen.create');
    Route::post('/pen/store', [\App\Http\Controllers\PenController::class, 'store'])->name('pen.store');
    Route::post('/update',[\App\Http\Controllers\PenController::class,'update'])->name('pen.update');
    Route::delete('/delete',[\App\Http\Controllers\PenController::class,'destroy'])->name('pen.delete');


});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');