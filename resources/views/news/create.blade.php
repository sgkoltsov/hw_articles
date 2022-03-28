@extends('layout.master_without_sidebar')

@section('content')

	<div class="col-md-8">
		<h3 class="pb-4 mb-4 fst-italic border-bottom">
	        Форма добавления новости
	    </h3>

	    @include('layout.errors')

		<form method="post" action="/news">

			@csrf

			@include('news.formfields')			
			
			<button type="submit" class="btn btn-primary mb-2" style="width: 200px;">Добавить новость</button>				
			
		</form>

		<a href="/admin/news">
            <button class="btn btn-secondary mb-2" style="width: 200px;">Отмена</button>
        </a>
	</div>

@endsection