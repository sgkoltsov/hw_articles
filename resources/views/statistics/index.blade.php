@extends('layout.master_without_sidebar')

@section('content')

    <h3 class="pb-4 mb-4 fst-italic border-bottom">
        Статистика сайта
    </h3>

    <article class="blog-post">
        <p>Общее количество статей: {{ $articlesCount }}</p>
        <p>Общее количество новостей: {{ $newsCount }}</p>
        <p>Авторы, у которых больше всего статей на сайте: <b>{{ $authorWithMaxNumberOfArticles->articles()->count() }}</b>
        	
        		<p><b>{{ $authorWithMaxNumberOfArticles->name }}</b></p>
        	
        </p>
        <p>Самая длинная статья: <b>{{ strlen($listMaxArticles[0]->body) }}</b></p>
        @foreach ($listMaxArticles as $article)
        	<a href="/articles/{{ $article->getRouteKey() }}">{{ $article->title }}</a>
        @endforeach

        <p>Самая короткая статья: <b>{{ strlen($listMinArticles[0]->body) }}</b></p>
        @foreach ($listMinArticles as $article)
        	<a href="/articles/{{ $article->getRouteKey() }}">{{ $article->title }}</a>
        @endforeach

        <p>Средние количество статей у активных пользователей: <b>{{ $averageNumberOfArticles }}</b></p>

        <p>
        	Самая изменяемая статья: 
        	<a href="/articles/{{ $unstableArticle ? $unstableArticle->getRouteKey() : '' }}">
        		{{ $unstableArticle ? $unstableArticle->title : '' }}
        	</a>
        </p>

        <p>
        	Самая обсуждаемая статья: 
        	<a href="/articles/{{ $discussedArticle ? $discussedArticle->getRouteKey() : '' }}">
        		{{ $discussedArticle ? $discussedArticle->title : '' }}
        	</a>
        </p>

        <hr>
    </article>
            
@endsection
