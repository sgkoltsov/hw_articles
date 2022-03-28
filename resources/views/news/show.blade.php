@extends('layout.master')

@section('content')

<div class="col-md-8">

    <article class="blog-post mb-0">

        <h2 class="blog-post-title">{{ $news->title }}</h2>

        @include('tags.tags', ['tags' => $news->tags])

        <p class="blog-post-meta mb-0">Дата создания: {{  $news->created_at->toFormattedDateString() }}</p>  
        <hr>
        <p>{{ $news->body }}</p>
                              
    </article>

    @include('comments.show', ['comments' => $news->comments])

    @include('comments.create', ['model' => $news]) 

    <a class="mb-2" href="/news">Вернуться к списку новостей</a>

</div>
    
@endsection

