<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbacksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index()
    {
        $feedbacks = Feedback::latest()->get();

        return view('admin.feedback.index', compact('feedbacks'));
    }

    public function create()
    {
        return view('admin.feedback.create');
    }

    public function store()
    {
        $this->validate(request(), [
            'email' => 'required | email',            
            'body' => 'required',
        ]);

        Feedback::create([
            'email' => request('email'),           
            'body' => request('body'),            
        ]);            

        return redirect('/'); 
    }
}
