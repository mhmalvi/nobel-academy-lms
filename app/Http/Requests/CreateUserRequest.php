<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8|max:20',
            'fName' => 'required',
            'lName' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'user_type' => 'required',
            'avatar' => [
                'image',
                Rule::dimensions()->maxWidth(300)->maxHeight(300)->ratio(1 / 1),
                'max:1048'
            ],
        ];
    }
}
