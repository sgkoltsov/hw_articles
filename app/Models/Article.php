<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Mail\ArticleActions;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Arr;

class Article extends Model
{
    use HasFactory;

    // public $guarded = [];
    public $fillable = ['slug', 'title', 'short', 'body', 'published', 'user_id'];

    protected static function boot()
    {
        parent::boot();

        static::updating(function($article) {

            $after = $article->getDirty();

            $article->history()->attach(auth()->id(), [
                'before' => json_encode(Arr::only($article->fresh()->toArray(), array_keys($after))),
                'after' => json_encode($after),
            ]);
        });
    }

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

    public function admin()
    {
        return User::where('email', config('services.admin.email'))->first();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function history()
    {
        return $this->belongsToMany(User::class, 'article_histories')->withPivot(['before', 'after'])->withTimestamps();
    }
}
