@extends('layout.master_without_sidebar')

@section('content')

	<div class="col-md-8">
		<h3 class="pb-4 mb-4 fst-italic border-bottom">
	        Форма редактирования новости
	    </h3>

	    @include('layout.errors')

		<form method="post" action="/news/{{ $news->id }}">

			@csrf

			<div class="mb-3">
				<label for="inputTitleNews" class="form-label">Заголовок</label>
				<input 
					type="text" 
					class="form-control" 
					id="inputTitleNews" 
					name="title"
					value="{{ old('title', isset($news) ? $news->title : '') }}"
				>		
			</div>

			<div class="mb-3">
				<label for="inputBodyNews" class="form-label">Описание</label>
				<textarea class="form-control" id="inputBodyNews" name="body" style="min-height: 150px;">{{ old('body', isset($news) ? $news->body : '') }}</textarea>
			</div>		

			<button type="submit" class="btn btn-primary mb-2" style="width: 200px;">Изменить новость</button>
		</form>		

        <div class="btn-group">
		  <form method="post" action="/news/{{ $news->id }}">

	            @csrf
	            @method('delete')

	            <button type="submit" class="btn btn-danger mb-2 me-2" style="width: 200px;">Удалить</button>
	        </form>

	        <a href="/admin/news">
	            <button class="btn btn-secondary mb-2" style="width: 200px;">Отмена</button>
	        </a>
		</div>

	</div>

@endsection