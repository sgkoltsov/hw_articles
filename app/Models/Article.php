<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Mail\ArticleActions;

class Article extends Model
{
    use HasFactory;

    // public $guarded = [];
    public $fillable = ['slug', 'title', 'short', 'body', 'published', 'user_id'];    

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
