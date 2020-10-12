<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;

class UpdateProfile extends FormRequest
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
                'string',
                'min:3',
                'max:255',
            ],
            'username' => [
                'nullable',
                'string',
                'min:3',
                'max:255',
                Rule::unique(User::class)->ignore(Auth::id()),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore(Auth::id()),
            ]
        ];
    }
}
