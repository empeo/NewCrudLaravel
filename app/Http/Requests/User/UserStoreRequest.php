<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'conpassword' => 'required|min:8|same:password',
            'phone' => 'required|min:10|regex:/^[0-9]{11}$/',
            'image' => 'required|mimes:jpg,jpeg,png|max:1024',
            'gender' => 'required|in:male,female'
        ];
    }
}
