@extends('layout.master')

@section('content')

	<h3 class="pb-4 mb-4 fst-italic border-bottom">
        Страница изменения статьи
    </h3>

    @include('layout.errors')

	<form method="post" action="/articles/{{ $article->slug }}">

		@csrf
		@method('patch')

		@include('articles.formfields')

		

		<button type="submit" class="btn btn-primary mb-2">Изменить</button>
	</form>

@endsection