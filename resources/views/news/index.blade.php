@extends('layout.master')

@section('content')

    <div class="col-md-8">

        <h1 class="fst-italic border-bottom">
            Новости
        </h1>   

        @foreach($news as $item)        
            <article class="blog-post mb-0">
                <h2 class="blog-post-title"><a href="/news/{{ $item->id }}">{{ $item->title }}</a></h2>            
                <p class="blog-post-meta mb-0">Дата создания: {{  $item->created_at }}</p>

                @include('tags.tags', ['tags' => $item->tags])

            </article>
        @endforeach

        {{ $news->links() }}

    </div>
    
@endsection

