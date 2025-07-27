<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // allow for now, use policies if needed
    }

    public function rules(): array
    {
        return [
            'title'             => 'required|string|max:255',
            'slug'              => 'nullable|string|max:255|unique:blogs,slug,' . $this->id,
            'content'           => 'required|string',
            'banner'            => 'nullable|image|max:2048', // optional file
            'banner_alt'        => 'nullable|string|max:255',
            'image'             => 'nullable|image|max:2048', // optional file
            'image_alt'         => 'nullable|string|max:255',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string|max:255',
            'meta_keyword'      => 'nullable|string|max:255',
            'status'            => 'required|in:draft,published',
        ];
    }
}
