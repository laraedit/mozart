<?php

namespace Mozart\Http\Requests;

use Mozart\Server;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class EditServerRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $server = Server::where('name', $request->get('name'))->firstOrFail();

        return [
            'name'          => 'required|alpha_dash|unique:servers,name,'.$server->id,
            'ip'            => 'required|ip',
            'identity_id'   => 'required|exists:identities,id'
        ];
    }
}
