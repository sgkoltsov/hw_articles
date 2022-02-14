<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articletag;

class TagController extends Controller
{
    public function index(Articletag $tag)
    {
        $articles = $tag->articles()->with('tags')->get();

        return view('welcome', compact('articles'));
    }
}
