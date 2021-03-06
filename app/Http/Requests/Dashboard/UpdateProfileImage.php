<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileImage extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'profile_image' => [
                'required',
                'file',
                'max:1024',
                'mimes:jpg,jpeg,png,svg',
                Rule::dimensions()->maxWidth(1000)->maxHeight(1000)->minWidth(150)->minHeight(150)
            ]
        ];
    }
}
