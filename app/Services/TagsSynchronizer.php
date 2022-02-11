<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Articletag;

class TagsSynchronizer
{
	public function sync($tags, \App\Models\Article $model)
	{
		// Теги, привязанные к статье до изменений	   
	    $tagsFromArticle = $model->tags->keyBy('name');

	    // Список тегов, пришедший из формы создания/изменения ствтьи
	    $tagsFromForm = $tags->keyBy(function($item) { return $item; });	    

	    // метод intersectByKeys() вернет теги, которые есть и в БД и пришедшие из формы
	    $syncIds = $tagsFromArticle->intersectByKeys($tagsFromForm)->pluck('id')->toArray();             

	    $tagsToAttach = $tagsFromForm->diffKeys($tagsFromArticle);

	    foreach ($tagsToAttach as $tag) {
	        $tag = Articletag::firstOrCreate(['name' => $tag]);

	        $syncIds[] = $tag->id;
	    }

	    $model->tags()->sync($syncIds);
	}
}