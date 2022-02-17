<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Tag;

class TagsSynchronizer
{
	public function sync($tags, Article $model)
	{
		$syncIds = [];

	    foreach ($tags as $tag) {
	        $tag = Tag::firstOrCreate(['name' => $tag]);

	        $syncIds[] = $tag->id;
	    }

	    $model->tags()->sync($syncIds);
	}
}