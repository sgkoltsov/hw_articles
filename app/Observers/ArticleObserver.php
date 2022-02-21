<?php

namespace App\Observers;

use App\Models\Article;
use App\Mail\ArticleActions;

class ArticleObserver
{
    /**
     * Handle the Article "created" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function created(Article $article)
    {        
        \Mail::to(config('services.admin.email'))->send(
            new ArticleActions($article, 'Создание новой статьи')
        );        
    }

    /**
     * Handle the Article "updated" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function updated(Article $article)
    {        
        \Mail::to(config('services.admin.email'))->send(
            new ArticleActions($article, 'Изменение статьи')
        );        
    }

    /**
     * Handle the Article "deleted" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function deleted(Article $article)
    {
        \Mail::to(config('services.admin.email'))->send(
            new ArticleActions($article, 'Удаление статьи', true)
        );
    }

    /**
     * Handle the Article "restored" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function restored(Article $article)
    {
        //
    }

    /**
     * Handle the Article "force deleted" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function forceDeleted(Article $article)
    {
        //
    }
}
