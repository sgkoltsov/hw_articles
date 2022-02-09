@extends('layout.master')

@section('content')

	<h3 class="pb-4 mb-4 fst-italic border-bottom">
        Страница добавления новой статьи
    </h3>

    @include('layout.errors')

	<form method="post" action="/">

		@csrf

		@include('articles.formfields')

		<button type="submit" class="btn btn-primary mb-2">Добавить статью</button>
	</form>

@endsection