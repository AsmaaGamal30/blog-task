<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', 'max:20', 'min:8'],
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'The name is required',
            'username.string' => 'The name should be a valid string',
            'username.max' => 'The name is too long',
            'email.required' => 'The email is required',
            'email.email' => 'The email should be a valid email',
            'email.unique' => 'This email exists in the system, login or try another email',
            'password.required' => 'The password is required',
            'password.confirmed' => 'Please confirme the password',
            'password.max' => 'The password is too long',
            'password.min' => 'The password is too short',
        ];
    }
}
