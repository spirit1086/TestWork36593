<?php

namespace App\Api\Book\Validation;

use Illuminate\Foundation\Http\FormRequest;

class BookValidate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'author'=> 'required',
            'published'=> 'required',
            'book_category'=> 'required',
            'price'=>'required'
        ];
    }
}
