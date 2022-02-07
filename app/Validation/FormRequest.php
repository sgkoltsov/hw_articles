<?php 

namespace App\Validation;

use Illuminate\Http\Request;

class FormRequest
{
	public static function createValid(Request $request)
	{
		$attributes = $request->validate([
            'slug' => 'required|unique:articles|alpha_dash',
            'title' => 'required|min:5|max:100',
            'short' => 'required|max:255',
            'body' => 'required',
        ]);

        $attributes['published'] = request()->has('published');

        return $attributes;
	}

	public static function updateValid(Request $request)
	{
		$attributes = $request->validate([            
            'title' => 'required|min:5|max:100',
            'short' => 'required|max:255',
            'body' => 'required',            
        ]);

        $attributes['published'] = request()->has('published');

        return $attributes;
	}
}