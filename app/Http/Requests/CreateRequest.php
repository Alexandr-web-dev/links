<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'link' => 'required|string',
            'limit' => 'required|integer|min:0',
            'time' => 'required|integer|min:1|max:24',
        ];
    }
}
