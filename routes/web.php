<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\FeedbacksController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\DB;
use App\Models\Article;
use App\Models\User;

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

Route::get('/statistics', function() {

	// поиск авторов с максимальным количеством статей
	// $arrNumArticles = [];

	// foreach (User::get() as $user) {
	// 	$arrNumArticles[$user->id] = Article::where('user_id', $user->id)->count();
	// };

	// $maxNumArticles = max($arrNumArticles);

	// $listUsers = [];

	// foreach ($arrNumArticles as $key => $value) {
	// 	if ($value === $maxNumArticles) {
	// 		$listUsers[] = User::where('id', '=', $key)->first();
	// 	}
	// }

	// поиск самой длинной статьи
	$arrLengthArticles = [];

	foreach (Article::get() as $article) {
		$arrLengthArticles[$article->id] = strlen($article->body);
	}

	$maxLengthArticles = max($arrLengthArticles);	

	$listMaxArticles = [];

	foreach ($arrLengthArticles as $key => $value) {
		if ($value === $maxLengthArticles) {
			$listMaxArticles[] = Article::where('id', '=', $key)->first();
		}
	}

	// поиск самой короткой статьи
	$minLengthArticles = min($arrLengthArticles);	

	$listMinArticles = [];

	foreach ($arrLengthArticles as $key => $value) {
		if ($value === $minLengthArticles) {
			$listMinArticles[] = Article::where('id', '=', $key)->first();
		}
	}

	// самая изменяемая статья
	$unstableArticle = DB::table('article_histories')
		->select(DB::raw('count(*) as change_count, article_id'))
		->groupBy('article_id')
		->orderByDesc('change_count')			
		->first()
	;

	// самая обсуждаемая статья
	$discussedArticle = DB::table('comments')
		->where('commentable_type', 'App\Models\Article')
		->select(DB::raw('count(*) as comments_count, commentable_id'))
		->groupBy('commentable_id')
		->orderByDesc('comments_count')			
		->first()
	;
		

	return view('statistics', [

		'articlesCount' => DB::table('articles')->count(),

		'newsCount' => DB::table('news')->count(),

		'authorWithMaxNumberOfArticles' => User::where('id', DB::table('articles')
				->select(DB::raw('count(*) as articles_count, user_id'))
				->groupBy('user_id')
				->orderByDesc('articles_count')
				->first()
				->user_id
			)->first()
		,

		'listMaxArticles' => $listMaxArticles,

		'listMinArticles' => $listMinArticles,

		'averageNumberOfArticles' => DB::table('articles')
			->select(DB::raw('count(*) as articles_count, user_id'))
			->groupBy('user_id')			
			->get()
			->where('articles_count', '>', 1)
			->avg('articles_count')
		,

		'unstableArticle' => $unstableArticle ? Article::where('id', $unstableArticle->article_id)->first() : '',

		'discussedArticle' => $discussedArticle ? Article::where('id', $discussedArticle->commentable_id)->first() : '',
	]);
});

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
