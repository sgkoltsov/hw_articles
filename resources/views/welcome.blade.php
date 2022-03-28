@extends('layout.master')

@section('content')

    <div class="col-md-8">

        @if (auth()->check() && $unpublishedUserArticles->isNotEmpty())
            <h3 class="pb-4 mb-4 fst-italic border-bottom" style="color:red">
                Неопубликованные статьи пользователя:
            </h3>

            @foreach($unpublishedUserArticles as $article)        
                <article class="blog-post mb-0">
                    <h2 class="blog-post-title"><a href="/articles/{{ $article->slug }}" style="color:red">{{ $article->title }}</a></h2>

                    @include('tags.tags', ['tags' => $article->tags])

                    <p class="blog-post-meta mb-0">Пользователь: {{ $article->owner->name }}</p>
                    <p class="blog-post-meta mb-0">Дата создания: {{  $article->created_at->toFormattedDateString() }}</p>
                    <p class="blog-post-meta">Дата последнего редактирования: {{  $article->updated_at->toFormattedDateString() }}</p>
                    <p>{{ $article->short }}</p>            
                </article>
            @endforeach

            {{ $unpublishedUserArticles->links() }}

        @endif

        <h3 class="pb-4 mb-4 fst-italic border-bottom">
            Список опубликованных статей
        </h3>

        @foreach($articles as $article)        
            <article class="blog-post mb-0">
                <h2 class="blog-post-title"><a href="/articles/{{ $article->slug }}">{{ $article->title }}</a></h2>

                @include('tags.tags', ['tags' => $article->tags])

                <p class="blog-post-meta mb-0">Пользователь: {{ $article->owner->name }}</p>
                <p class="blog-post-meta mb-0">Дата создания: {{  $article->created_at->toFormattedDateString() }}</p>
                <p class="blog-post-meta">Дата последнего редактирования: {{  $article->updated_at->toFormattedDateString() }}</p>
                <p>{{ $article->short }}</p>            
            </article>
        @endforeach

        {{ $articles->links() }}

    </div>
    
@endsection

