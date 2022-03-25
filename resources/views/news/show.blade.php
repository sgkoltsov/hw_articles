@extends('layout.master_without_sidebar')

@section('content')

    <article class="blog-post mb-0">

        <h2 class="blog-post-title">{{ $news->title }}</h2>
        <p class="blog-post-meta mb-0">Дата создания: {{  $news->created_at->toFormattedDateString() }}</p>  
        <hr>
        <p>{{ $news->body }}</p>
                              
    </article>    

    <a class="mb-2" href="/news">Вернуться к списку новостей</a>
    
@endsection

