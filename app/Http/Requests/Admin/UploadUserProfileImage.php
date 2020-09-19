<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UploadUserProfileImage extends FormRequest
{
    public function authorize()
    {
        return (isAuthRoleAdmin()) ? true : false;
    }

    public function rules()
    {
        return [
            'id' => [
                'required',
                'numeric',
                Rule::exists('users')
            ],
            'profile_image' => [
                'file',
                'max:1024',
                'mimes:jpg,jpeg,png,svg',
                Rule::dimensions()->maxWidth(1000)->maxHeight(1000)->minWidth(150)->minHeight(150)
            ]
        ];
    }
}
