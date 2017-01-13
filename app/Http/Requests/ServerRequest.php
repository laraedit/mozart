<?php

namespace Mozart\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServerRequest extends FormRequest
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
            'name'          => 'required|alpha_dash|unique:servers,name',
            'ip'            => 'required|ip|unique:servers,ip',
            'identity_id'   => 'required|exists:identities,id',
        ];
    }
}
