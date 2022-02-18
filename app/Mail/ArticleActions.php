<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Article;

class ArticleActions extends Mailable
{
    use Queueable, SerializesModels;

    public $article;
    public $type;
    public $deleteArticle;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Article $article, $type, $deleteArticle = false)
    {
        $this->article = $article;
        $this->type = $type;
        $this->deleteArticle = $deleteArticle;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.article_actions');
    }
}
