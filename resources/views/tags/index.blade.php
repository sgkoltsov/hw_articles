@extends('layout.master')

@section('content')

    <div class="col-md-8">

    	<h2 class="pb-4 mb-4 fst-italic border-bottom" >
            Статьи и новости, привязанные к тегу: <span class="p-2 bg-warning" style="border-radius: 5px">{{ $tag->name }}</span>
        </h2>

        <div class="row mb-2">

		    <div class="col border me-2">
		    
		    	@if (auth()->check() && $unpublishedUserArticles->isNotEmpty())
		            <h4 class="p-4 fst-italic border-bottom text-primary">
		                Неопубликованные статьи:
		            </h4>

		            @foreach($unpublishedUserArticles as $article)        
		                <article class="blog-post mb-0">
		                    <h4 class="p-2"><a class="text-danger" href="/articles/{{ $article->slug }}">{{ $article->title }}</a></h4>

		                    @include('tags.tags', ['tags' => $article->tags])

		                    <p class="fs-6 m-0 fw-light">Пользователь: {{ $article->owner->name }}</p>
		                    <p class="fs-6 m-0 fw-light">Дата создания: {{  $article->created_at->toFormattedDateString() }}</p>
		                    <p class="fs-6 m-0 fw-light mb-4">Дата последнего редактирования: {{  $article->updated_at->toFormattedDateString() }}</p>
		                    <p class="blog-post-meta fs-5">{{ $article->short }}</p>            
		                </article>
		            @endforeach            

		        @endif

		        <h4 class="p-4 fst-italic border-bottom text-primary">
		            Опубликованные статьи:
		        </h4>

		        @foreach($articles as $article)        
		            <article class="blog-post mb-0">
		                <h4 class="p-2"><a class="text-success" href="/articles/{{ $article->slug }}">{{ $article->title }}</a></h4>

		                @include('tags.tags', ['tags' => $article->tags])

		                <p class="fs-6 m-0 fw-light">Пользователь: {{ $article->owner->name }}</p>
		                <p class="fs-6 m-0 fw-light">Дата создания: {{  $article->created_at->toFormattedDateString() }}</p>
		                <p class="fs-6 m-0 fw-light">Дата последнего редактирования: {{  $article->updated_at->toFormattedDateString() }}</p>
		                <p class="blog-post-meta fs-5">{{ $article->short }}</p>            
		            </article>
		        @endforeach

		    </div>

		    <div class="col border">
		    
		    	<h4 class="p-4 fst-italic border-bottom text-primary">
			        Новости:
			    </h4>

			    @foreach($news as $item)        
			        <article class="blog-post mb-0">
			            <h4 class="p-2"><a class="text-success" href="/news/{{ $item->getRouteKey() }}">{{ $item->title }}</a></h4>

			            @include('tags.tags', ['tags' => $item->tags])
			            
			            <p class="fs-6 m-0 fw-light">Дата создания: {{  $item->created_at->toFormattedDateString() }}</p>
			            <p class="fs-6 m-0 fw-light">Дата последнего редактирования: {{  $item->updated_at->toFormattedDateString() }}</p>                            
			        </article>
			    @endforeach

		    </div>

	    </div>

        

              

    </div>
    
@endsection
