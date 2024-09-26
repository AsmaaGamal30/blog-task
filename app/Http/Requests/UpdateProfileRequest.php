<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
        $user = Auth::user();

        return [
            'username' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id),],
            'old_password' => ['nullable', 'required_with:new_password', 'string', 'max:20', 'min:8', 'current_password'],
            'new_password' => ['nullable', 'string', 'max:20', 'min:8'],
        ];
    }

    public function messages()
    {
        return [
            'username.string' => 'The name must be a string.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'old_password.required_with' => 'The old password is required.',
            'old_password.min' => 'The old password must be at least 8 characters.',
            'old_password.max' => 'The old password is too long',
            'old_password.current_password' => 'The current password is wrong',
            'new_password.min' => 'The new password must be at least 8 characters.',
            'new_password.max' => 'The new password is too long',
        ];
    }
}