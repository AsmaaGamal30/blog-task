<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'string', 'max:255', 'min:2'],
            'body' => ['sometimes', 'string', 'min:5'],
            'image' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,png', 'max:2048'],
        ];
    }

    public function messages()
    {
        return [
            'body.required' => 'The body is required.',
            'title.min' => 'The title is too short',
            'body.min' => 'The body is too short',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png.',
            'image.max' => 'The image must not be larger than 2MB.',
        ];
    }
}
