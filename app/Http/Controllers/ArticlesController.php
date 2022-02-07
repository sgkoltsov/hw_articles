<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->get();

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
        $this->validate(request(), [
            'slug' => 'required|unique:articles|alpha_dash',
            'title' => 'required|min:5|max:100',
            'short' => 'required|max:255',
            'body' => 'required',
        ]);
        
        Article::create([
            'slug' => request('slug'),
            'title' => request('title'),
            'short' => request('short'),
            'body' => request('body'),
            'published' => request()->has('published'),        
        ]);            

        return redirect('/');          
    }
    
    public function show(Article $slug)
    {
        return view('articles.show', compact('slug'));
    }
}
