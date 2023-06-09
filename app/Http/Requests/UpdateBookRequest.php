<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'cover' => 'image|mimes:jpeg,png,gif|max:2048',
        ];
    }
}
