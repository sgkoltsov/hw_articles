<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
// use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Validator;

class ArticleUpdateValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $collection = \App\Models\Article::where('slug', '=', $this->slug)->get();

        foreach ($collection as $article) {        
            $validator = Validator::make($this->all(), [
                'slug' => [
                    'required',
                    'alpha_dash',
                    Rule::unique('articles')->ignore($article->id),
                ],             
                'title' => ['required', 'min:5', 'max:100'],
                'short' => ['required', 'max:255'],
                'body' => ['required'],
            ]);
        }

        return $validator;
    }
}
