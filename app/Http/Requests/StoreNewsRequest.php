<?php

namespace App\Http\Requests;

use App\Models\Author;
use App\Models\Category;
use App\Models\News;
use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
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
        $tableCategory =(new Category())->getTable();
        $tableAuthor = (new Author())->getTable();

        return [
            'title' => 'required|min:50|max:200',
            'spoiler' => 'required|min:200|max:500',
            'content' => 'required|min:2000|max:5000',
            'content_second' => 'required|min:2000|max:5000',
            'images' => 'required',
            'id_category' => "required|integer|exists:{$tableCategory},id_category",
            'id_author' => "required|integer|exists:{$tableAuthor},id_author"
        ];
    }
}
