<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        
        return [
            'title'=>['required','string'],
            'cover'=>['nullable','mimes:png,jpg'],
            'content'=>['required','string'],
        ];
        
       
    }
   
}
