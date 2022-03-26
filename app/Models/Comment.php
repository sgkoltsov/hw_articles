<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;

    public $fillable = ['body', 'user_id', 'commentable_id', 'commentable_type'];

    public function user() 
    {
        $this->belongsTo(User::class);
    }

    // public function article() 
    // {
    //     $this->belongsTo(Article::class);
    // }

    public function commentable() 
    {
        $this->morphTo();
    }

    public function owner()
    {
        return User::where('id', $this->user_id)->first();
    }
}
