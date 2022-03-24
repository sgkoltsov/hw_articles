<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\ArticleCreateValidation;
use App\Http\Requests\ArticleUpdateValidation;
use App\Services\TagsSynchronizer;
use App\Services\Pushall;

class ArticlesController extends Controller
{
    private TagsSynchronizer $sync;

    public function __construct(TagsSynchronizer $sync)
    {
        $this->sync = $sync;        
        $this->middleware('can:update,article')->only('edit', 'update');
        $this->middleware('can:delete,article')->only('destroy');        
    } 

    public function index()
    {
        // $articles = Article::with('tags')
        //     ->latest('updated_at')
        //     ->where('published', '1')            
        //     ->get()
        // ;

        // $unpublishedUserArticles = collect();

        // if (auth()->check()) {
        //     $unpublishedUserArticles = Article::with('tags')
        //         ->latest('updated_at')
        //         ->where('published', '0')
        //         ->where('user_id', auth()->user()->id)                
        //         ->get()
        //     ;
        // } 
        
        // return view('welcome', compact('articles', 'unpublishedUserArticles'));

        return view('welcome', [
            'articles' => Article::with('tags')
                ->latest('updated_at')
                ->where('published', '1')
                ->simplePaginate($perPage = 5, $columns = ['*'], $pageName = 'published')
            ,

            'unpublishedUserArticles' => auth()->check() ? Article::with('tags')
                ->latest('updated_at')
                ->where('published', '0')
                ->where('user_id', auth()->user()->id)
                ->simplePaginate($perPage = 2, $columns = ['*'], $pageName = 'unpublished') : collect()
            ,
        ]);
    }

    public function create()
    {
        return view('articles.create');
    }    

    public function store(ArticleCreateValidation $request, Pushall $pushall)

    {
        $attributes = $request->validated();

        $attributes['published'] = $request->has('published');
        $attributes['user_id'] = auth()->id();

        $article = Article::create($attributes);

        $this->sync->sync(explode(',', $request->tags), $article);

        $pushall->send('Создана новая статья', $attributes['title']);

        return redirect('/');        
    }
    
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }
    
    public function update(Article $article, ArticleUpdateValidation $request)
    {
        $attributes = $request->validated();        

        $attributes['published'] = $request->has('published');

        $article->update($attributes);

        $this->sync->sync(explode(',', $request->tags), $article);        

        return redirect(auth()->user()->isAdmin() ? '/admin/articles' : '/');
    }

    public function destroy(Article $article)
    {  
        $article->delete();

        return redirect(auth()->user()->isAdmin() ? '/admin/articles' : '/');
    }
}
