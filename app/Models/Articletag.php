<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articletag extends Model
{
    use HasFactory;

    public $fillable = ['name'];

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    public static function tagsCloud()
    {
        return (new static)->has('articles')->get();
    }
}
