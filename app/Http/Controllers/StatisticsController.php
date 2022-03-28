<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Article;
use App\Models\User;

class StatisticsController extends Controller
{
    public function index()
    {
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
            

        return view('statistics.index', [

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
    }
}
