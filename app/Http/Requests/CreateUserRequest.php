<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required','min:3', 'max:50'],
            'email' => ['email','unique:users,email'],
            'role' => ['required', Rule::in(['super', 'admin'])],
            'password' => ['required', 'confirmed', 'min:6'],
            'foto_profile' => ['image']
        ];
    }
}
