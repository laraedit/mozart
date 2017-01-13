@extends('layouts.app')

@section('content')
<div class="panel-heading">
    Identities
    <a href="/identities/create" class="btn btn-xs btn-success pull-right"><i class="fa fa-plus"></i> New Identity</a>
    <div class="clearfix"></div>
</div>

<table class="table">
	<thead>
		<td>Identity Name</td>
		<td>Username</td>
		<td>Key Set</td>
		<td>Identity Type</td>
		<td></td>
	</thead>
    @foreach($identities as $identity)
    	<tr>
    		<td>{{ $identity->name }}</td>
    		<td>{{ $identity->user }}</td>

    		<td>
    			@if($identity->secret_key)
    				{{ $identity->secret_key }}
    			@endif
    		</td>

    		<td>
    			@if($identity->identity_type == 0)
    				SSH Key
    			@else
    				Username/Password
    			@endif
    		</td>

    		<td>
    			<a href="/identities/{{ $identity->id }}/edit" class="btn btn-xs btn-primary"><i class="fa fa-fw fa-edit"></i> Edit</a>
    		</td>
    	</tr>
    @endforeach
</table>

@endsection
