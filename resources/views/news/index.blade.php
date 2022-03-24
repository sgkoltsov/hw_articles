@extends('layout.master_without_sidebar')

@section('content')

    <h1 class="fst-italic border-bottom">
        Новости
    </h1>   

    @foreach($news as $item)        
        <article class="blog-post mb-0">
            <h2 class="blog-post-title"><a href="/news/{{ $item->id }}">{{ $item->title }}</a></h2>            
            <p class="blog-post-meta mb-0">Дата создания: {{  $item->created_at }}</p>                       
        </article>
    @endforeach

    {{ $news->links() }}
    
@endsection

