<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserUpdateRequest extends FormRequest
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
        $userId = $this->route("user");
        return [
            'name' => 'sometimes|min:5',
            'email' => 'sometimes|email|unique:users,email,'.$userId,
            'password' => 'nullable|min:8',
            'conpassword' => 'same:password',
            'phone' => 'sometimes|min:10|regex:/^[0-9]{11}$/',
            'image' => 'sometimes|mimes:jpg,jpeg,png|max:1024',
            'gender' => 'sometimes|in:male,female',
        ];
    }
}
