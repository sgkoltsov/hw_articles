@extends('layout.master')

@section('content')

    <div class="col-md-8">
        <h3 class="pb-0 mb-0 fst-italic">
            {{ $article->title }}  
        </h3>

        @include('articles.tags', ['tags' => $article->tags])
             
        <p class="blog-post-meta mb-0">Дата создания: {{  $article->created_at->toFormattedDateString() }}</p>
        <p class="blog-post-meta">Дата последнего редактирования: {{  $article->updated_at->toFormattedDateString() }}</p>
        <hr>
        <p>{{ $article->body }}</p>
        <hr>
        <div class="btn-group">

            <a href="/articles/{{ $article->slug }}/edit">
                <button class="btn btn-primary me-4" style="width: 150px;">Редактировать</button>
            </a>

            <form method="post" action="/articles/{{ $article->slug }}">

                @csrf
                @method('delete')

                <button type="submit" class="btn btn-danger" style="width: 150px;">Удалить</button>
            </form>            
        </div>
        <hr>
        <a class="link-info" href="/">Вернуться к списку статей</a>
    </div>

@endsection