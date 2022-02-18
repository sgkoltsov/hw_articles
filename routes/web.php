<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\FeedbacksController;
use App\Http\Controllers\TagsController;

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

Route::get('/', [ArticlesController::class, 'index']);
Route::get('/articles/create', [ArticlesController::class, 'create'])->middleware('auth');
Route::post('/', [ArticlesController::class, 'store'])->middleware('auth');
Route::get('/articles/{article}', [ArticlesController::class, 'show']);
Route::get('/articles/{article}/edit', [ArticlesController::class, 'edit']);
Route::patch('/articles/{article}', [ArticlesController::class, 'update']);
Route::delete('/articles/{article}', [ArticlesController::class, 'destroy']);

Route::get('/about', function() {
	return view('about');
});

Route::get('/contacts', [FeedbacksController::class, 'create']);
Route::post('/admin/feedback', [FeedbacksController::class, 'store']);
Route::get('/admin/feedback', [FeedbacksController::class, 'index']);

Route::get('/articles/tags/{tag}', [TagsController::class, 'index']);

Auth::routes();
