@extends('layout.master')

@section('content')

	<div class="col-md-8">
		<h3 class="pb-4 mb-4 fst-italic border-bottom">
	        Страница изменения статьи
	    </h3>

	    @include('layout.errors')

		<form method="post" action="/articles/{{ $article->slug }}">

			@csrf
			@method('patch')

			@include('articles.formfields')		

			<button type="submit" class="btn btn-primary mb-2" style="width: 200px;">Изменить</button>
		</form>

		<div class="btn-group">

		  	<form method="post" action="/articles/{{ $article->slug }}">

	            @csrf
	            @method('delete')

	            <button type="submit" class="btn btn-danger mb-2 me-2" style="width: 200px;">Удалить</button>
	        </form>

	        <a href="{{ auth()->user()->isAdmin() ? '/admin/articles' : '/' }}">
	            <button class="btn btn-secondary mb-2" style="width: 200px;">Отмена</button>
	        </a>
		</div>

	</div>

@endsection