<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'email'=> 'email|string|max:100',
            'nik' => 'required|string|max:7|unique:users,nik',
            'password' => 'required|string|min:8|confirmed',
            'store_code' => 'required|string|max:4|exists:stores,store_code',
            'role' => 'required|string|in:admin,ops,cs,packer'
        ];
    }
}
