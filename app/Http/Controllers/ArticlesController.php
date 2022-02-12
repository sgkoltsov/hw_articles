<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\ArticleCreateValidation;
use App\Http\Requests\ArticleUpdateValidation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::latest('updated_at')->get();

        return view('welcome', compact('articles'));
    }

    public function about()
    {
        return view('about');
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(ArticleCreateValidation $request)
    {
        $attributes = $request->validated();
        $attributes['published'] = $request->has('published');

        Article::create($attributes);      

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

    public function update(Article $article, Request $request)
    {
        // $attributes = $request->validated();

        $validator = Validator::make($request->all(), [
            'slug' => [
                'required',
                'alpha_dash',
                Rule::unique('articles')->ignore($article),
            ],             
            'title' => 'required|min:5|max:100',
            'short' => 'required|max:255',
            'body' => 'required',
        ]);

        $attributes = $validator->validated();

        $attributes['published'] = $request->has('published');        

        $article->update($attributes);

        return redirect('/');
    }

    public function destroy(Article $article)
    {        
        $article->delete();

        return redirect('/');
    }
}
