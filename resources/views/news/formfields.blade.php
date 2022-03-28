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

<div class="form-group">
	<label for="inputTagsNews">Теги</label>
	<input
		type="text"
		name="tags"
		class="form-control"
		id="inputTagsNews"
		value="{{ old('tags', isset($news) ? $news->tags->pluck('name')->implode(',') : '') }}"
	>
</div>

<div class="mb-3">
	<label for="inputBodyNews" class="form-label">Описание</label>
	<textarea 
		class="form-control" 
		id="inputBodyNews" 
		name="body" 
		style="min-height: 150px;"
	>{{ old('body', isset($news) ? $news->body : '') }}</textarea>
</div>