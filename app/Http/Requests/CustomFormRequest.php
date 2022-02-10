<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Article;

class CustomFormRequest extends FormRequest
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
        return [
            'slug' => $this->route('article') ? '' : 'required|unique:articles|alpha_dash',
            'title' => 'required|min:5|max:100',
            'short' => 'required|max:255',
            'body' => 'required',            
        ];
    }
}
