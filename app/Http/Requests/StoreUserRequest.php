<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
        $id = $this->route('user')->id;
        return [
            'name' => ['required','min:3', 'max:50'],
            'email' => ['email','unique:users,email,'.$id],
            'role' => ['required', Rule::in(['super', 'admin'])],
            'password' => ['nullable', 'confirmed', 'min:6']
        ];
    }
}
