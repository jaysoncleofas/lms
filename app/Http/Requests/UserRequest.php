<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'firstName'    => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'lastName'     => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'middleName'   => 'nullable|regex:/^[\pL\s\-]+$/u|max:255',
            'birthDate'    => 'nullable|max:255',
            'username'     => 'required|alpha_dash|unique:users|max:255',
            'email'        => 'required|string|email|unique:users|max:255',
            'mobileNumber' => 'nullable|alpha_num|digits:11|unique:users',
            'password'     => 'nullable|string|min:6|max:255',
        ];
    }
}
