<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Validation\FormRequest;

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

    public function store()
    {
        // $this->validate(request(), [
        //     'slug' => 'required|unique:articles|alpha_dash',
        //     'title' => 'required|min:5|max:100',
        //     'short' => 'required|max:255',
        //     'body' => 'required',
        // ]);
        
        Article::create(FormRequest::createValid(request()));         

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

    public function update(Article $article)
    {
        $article->update(FormRequest::updateValid(request()));

        return redirect('/');
    }

    public function destroy(Article $article)
    {        
        $article->delete();

        return redirect('/');
    }
}
