<div class="mb-3">
	<label for="inputSlug" class="form-label">Символьный код статьи</label>
	<input type="text" class="form-control" id="inputSlug" name="slug" 
		value="{{ old('slug', isset($article) ? $article->slug : '') }}"		
	>		
</div>

<div class="form-group">
	<label for="inputTags">Теги</label>
	<input
		type="text"
		name="tags"
		class="form-control"
		id="inputTags"
		value="{{ old('tags', isset($article) ? $article->tags->pluck('name')->implode(',') : '') }}"
	>
</div>

<div class="mb-3">
	<label for="inputTitle" class="form-label">Название статьи</label>
	<input type="text" class="form-control" id="inputTitle" name="title" value="{{ old('title', isset($article) ? $article->title : '') }}">		
</div>

<div class="mb-3">
	<label for="inputShort" class="form-label">Краткое описание статьи</label>
	<input type="text" class="form-control" id="inputShort" name="short" value="{{ old('short', isset($article) ? $article->short : '') }}">	
</div>

<div class="mb-3">
	<label for="inputBody" class="form-label">Детальное описание</label>
	<textarea class="form-control" id="inputBody" name="body" style="min-height: 150px;">{{ old('body', isset($article) ? $article->body : '') }}</textarea>
</div>

@admin
	<div class="mb-3 form-check">
		<input
			type="checkbox"
			class="form-check-input"
			id="exampleCheck1"
			name="published"
			@if(isset($article))
				{{ $article->published  ? 'checked' : '' }}
			@endif
			{{ null !== old('published') ? 'checked' : '' }}	
		>
		<label class="form-check-label" for="exampleCheck1">Опубликовано</label>
	</div>
@endadmin