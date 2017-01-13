<?php

namespace Mozart\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IdentityRequest extends FormRequest
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
            'name'          => 'required|alpha_dash|unique:identities,name',
            'user'          => 'required|alpha_dash',
            'password'      => 'required_if:identity_type,1',
            'secret_key'    => 'required_if:identity_type,0|file',
            'public_key'    => 'required_if:identity_type,0|file',
            'identity_type' => 'required|boolean'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'password.required_if'      => 'Password is required if identity type is Username/Password',
            'secret_key.required_if'    => 'Secret RSA Key is required if identity type is SSH Key',
            'public_key.required_if'    => 'Public RSA Key is required if identity type is SSH Key',
        ];
    }

}
