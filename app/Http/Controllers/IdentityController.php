<?php

namespace Mozart\Http\Controllers;

use Mozart\Identity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mozart\Http\Requests\IdentityRequest;
use Mozart\Http\Requests\EditIdentityRequest;

class IdentityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $identities = Identity::all();
        return view('identity.index', ['identities' => $identities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('identity.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IdentityRequest $request)
    {
        $key_name = str_random(20);

        $identity = new Identity;

        $identity->name = $request->name;
        $identity->user = $request->user;

        if ($request->password == null) {
            $identity->password = null;
        } else {
            $identity->password = encrypt($request->password);
        }

        if ($request->hasFile('secret_key')) {
            $request->secret_key->storeAs('keys', $key_name);
            $identity->secret_key = $key_name;
        }

        if ($request->hasFile('public_key')) {
            $request->secret_key->storeAs('keys', $key_name . '.pub');
            $identity->public_key = $key_name . '.pub';
        }

        $identity->identity_type = $request->identity_type;

        $identity->save();

        return redirect('/identities');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('identity.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $identity = Identity::findOrFail($id);
        return view('identity.edit', ['identity' => $identity]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditIdentityRequest $request, $id)
    {
        $key_name = str_random(20);

        $identity = Identity::findOrFail($id);

        if ($identity->name != $request->name) {
            $identity->name = $request->name;
        }

        if ($identity->user != $request->user) {
            $identity->user = $request->user;
        }

        if ($identity->password == null) {
            if ($request->password == null) {
                $identity->password = null;
            } else {
                $identity->password = encrypt($request->password);
            }
        } else {
            if ( decrypt($identity->password) != $request->password) {
                if ($request->password == null) {
                    $identity->password = null;
                } else {
                    $identity->password = encrypt($request->password);
                }
            }
        }

        $identity->save();

        return redirect('/identities'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $identity = Identity::find($id);

        Storage::delete('keys/'.$identity->secret_key);
        Storage::delete('keys/'.$identity->public_key);

        $identity->delete();

        return redirect('/identities');
    }
}
