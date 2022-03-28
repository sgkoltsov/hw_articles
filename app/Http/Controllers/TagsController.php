<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagsController extends Controller
{
    public function index(Tag $tag)
    {
        $news = $tag->news()->with('tags')->latest('updated_at')->get();

        $articles = $tag->articles()->with('tags')->latest('updated_at')->where('published', '1')->get();

        $unpublishedUserArticles = collect();

        if (auth()->check()) {
            $unpublishedUserArticles = $tag->articles()->with('tags')->latest('updated_at')->where('published', '0')->where('user_id', auth()->user()->id)->get();
        }

        return view('tags.index', compact('news', 'articles', 'unpublishedUserArticles', 'tag'));
    }
}
