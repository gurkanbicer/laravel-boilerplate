<?php

namespace App\Http\Requests\Common;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateOwnAccountDetails extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => [
                'required',
                'string',
                'min:3',
                'max:255'
            ],
            'last_name' => [
                'required',
                'string',
                'min:2',
                'max:255'
            ],
            'display_name' => [
                'nullable',
                'required',
                'string',
                'min:3',
                'max:255',
            ],
            'username' => [
                'nullable',
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('users')->ignore(Auth::id()),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore(Auth::id()),
            ]
        ];
    }
}
