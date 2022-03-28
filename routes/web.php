<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\FeedbacksController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\StatisticsController;


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

Route::post('/comments', [CommentsController::class, 'store']);

Route::get('/', [ArticlesController::class, 'index']);
Route::get('/articles/create', [ArticlesController::class, 'create'])->middleware('auth');
Route::post('/', [ArticlesController::class, 'store'])->middleware('auth');
Route::get('/articles/{article}', [ArticlesController::class, 'show'])->name('article.show');
Route::get('/articles/{article}/edit', [ArticlesController::class, 'edit']);
Route::patch('/articles/{article}', [ArticlesController::class, 'update']);
Route::delete('/articles/{article}', [ArticlesController::class, 'destroy']);

Route::get('/about', function() {
	return view('about');
});

Route::get('/statistics', [StatisticsController::class, 'index']);

Route::get('/contacts', [FeedbacksController::class, 'create']);
Route::post('/admin/feedback', [FeedbacksController::class, 'store']);
Route::get('/admin/feedback', [FeedbacksController::class, 'index'])->middleware('admin');

Route::get('/tags/{tag}', [TagsController::class, 'index']);

Route::get('/admin/articles', [AdminController::class, 'indexArticles']);
Route::get('/admin/news', [AdminController::class, 'indexNews']);

Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/create', [NewsController::class, 'create']);
Route::post('/news', [NewsController::class, 'store']);
Route::get('/news/{news}', [NewsController::class, 'show']);
Route::get('/news/{news}/edit', [NewsController::class, 'edit']);
Route::post('/news/{news}', [NewsController::class, 'update']);
Route::delete('/news/{news}', [NewsController::class, 'destroy']);

Auth::routes();
