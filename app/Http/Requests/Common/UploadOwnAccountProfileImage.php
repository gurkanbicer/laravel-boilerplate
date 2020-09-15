<?php

namespace App\Http\Requests\Common;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UploadOwnAccountProfileImage extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'profile_image' => [
                'file',
                'max:1024',
                'mimes:jpg,jpeg,png,svg',
                Rule::dimensions()->maxWidth(1000)->maxHeight(1000)->minWidth(150)->minHeight(150)
            ]
        ];
    }
}
