@extends('layouts.app')

@section('content')
<div class="panel-heading">
    Servers
    <a href="/servers/create" class="btn btn-xs btn-success pull-right"><i class="fa fa-plus"></i> New Server</a>
    <div class="clearfix"></div>
</div>

<table class="table">
	<thead>
		<td>Server Name</td>
		<td>IP Address</td>
		<td>Identity</td>
		<td></td>
	</thead>
    @foreach($servers as $server)
    	<tr>
    		<td>{{ $server->name }}</td>
    		<td>{{ $server->ip }}</td>
    		<td>{{ $server->identity->name }}</td>

    		<td>
    			<a href="/servers/{{ $server->id }}/edit" class="btn btn-xs btn-primary"><i class="fa fa-fw fa-edit"></i> Edit</a>
    		</td>
    	</tr>
    @endforeach
</table>

@endsection
