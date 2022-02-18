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

    protected static function booted()
    {
        static::created(function($article) {
            \Mail::to(config('services.admin.email'))->send(
                new ArticleActions($article, 'Создание новой статьи')
            );
        });

        static::updated(function($article) {
            \Mail::to(config('services.admin.email'))->send(
                new ArticleActions($article, 'Изменение статьи')
            );
        });

        static::deleted(function($article) {
            \Mail::to(config('services.admin.email'))->send(
                new ArticleActions($article, 'Удаление статьи', true)
            );
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
}
