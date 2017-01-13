<?php

namespace Mozart\Http\Controllers;

use Mozart\Server;
use Mozart\Identity;
use Illuminate\Http\Request;
use Mozart\Http\Requests\ServerRequest;
use Mozart\Http\Requests\EditServerRequest;

class ServerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servers = Server::all();
        return view('server.index', ['servers' => $servers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $identities = Identity::all();
        return view('server.create', ['identities' => $identities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServerRequest $request)
    {
        $server = new Server;

        $server->name           = $request->name;
        $server->ip             = $request->ip;
        $server->identity_id    = $request->identity_id;

        $server->save();

        return redirect('/servers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('server.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $server = Server::findOrFail($id);
        $identities = Identity::all();

        return view('server.edit', [
            'server' => $server,
            'identities' => $identities
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditServerRequest $request, $id)
    {
        $server = Server::findOrFail($id);
        
        $server->name = $request->name;
        $server->ip   = $request->ip;
        $server->identity_id = $request->identity_id;

        $server->save();

        return redirect('/servers/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $server = Server::findOrFail($id);

        $server->delete();

        return redirect('/servers');
    }
}
