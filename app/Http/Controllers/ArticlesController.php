<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\ArticleCreateValidation;
use App\Http\Requests\ArticleUpdateValidation;
use \App\Services\TagsSynchronizer;

class ArticlesController extends Controller
{
    private TagsSynchronizer $sync;

    public function __construct(TagsSynchronizer $sync)
    {
        $this->sync = $sync;        
        $this->middleware('can:update,article')->except('index', 'create', 'store');
        $this->middleware('can:delete,article')->only('destroy');
    } 

    public function index()
    {
        $articles = Article::with('tags')->latest('updated_at')->get();

        return view('welcome', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }    

    public function store(ArticleCreateValidation $request)

    {
        $attributes = $request->validated();

        $attributes['published'] = $request->has('published');
        $attributes['user_id'] = auth()->id();

        $article = Article::create($attributes);

        $this->sync->sync(explode(',', $request->tags), $article);

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

        return redirect('/');
    }

    public function destroy(Article $article)
    {        
        $article->delete();

        return redirect('/');
    }
}
