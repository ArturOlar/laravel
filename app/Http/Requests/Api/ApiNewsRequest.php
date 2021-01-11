<?php

namespace App\Http\Requests\Api;

use App\Models\Author;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ApiNewsRequest extends ApiRequest
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
            'title' => 'required|min:50|max:200|unique:news',
            'spoiler' => 'required|min:100|max:1000',
            'content' => 'required|min:1000|max:10000',
            'category' => "required|min:3|max:50",
            'author' => "required|min:3|max:50"
        ];
    }
}
