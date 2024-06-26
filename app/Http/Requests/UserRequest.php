<?php

namespace App\Http\Requests;

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
            "user" => "required|string|max:20",
            "password" => "required|string|min:8",
            "status" => "nullable|string|size:1|number",
            "person_id" => "nullable|integer|exists:people,id",
            "user_roles_id" => "required|integer|exists:user_roles,id",
        ];
    }
}
