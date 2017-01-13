@extends('layouts.app')

@section('content')
<div class="panel-heading">
    Edit {{ $identity->name }}
    <form class="pull-right" method="POST" role="form" action="{{ route('identities.destroy', ['id' => $identity->id]) }}">
    	{{ method_field('DELETE') }}
    	{{ csrf_field() }}
    	<button type="submit" class="btn btn-xs btn-danger">
            <i class="fa fa-fw fa-trash"></i> Delete
        </button>
    </form>
</div>

<div class="panel-body">
    <form class="form-horizontal" role="form" method="POST" action="{{ route('identities.update', ['id' => $identity->id]) }}" enctype="multipart/form-data">

        {{ method_field('PUT') }}
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Identity Name</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ $identity->name }}" required autofocus>

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('user') ? ' has-error' : '' }}">
            <label for="user" class="col-md-4 control-label">Username</label>

            <div class="col-md-6">
                <input id="user" type="text" class="form-control" name="user" value="{{ $identity->user }}" required>

                @if ($errors->has('user'))
                    <span class="help-block">
                        <strong>{{ $errors->first('user') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-4 control-label">Password (Optional)</label>

            <div class="col-md-6">
            	@if($identity->password != null)
                	<input id="password" type="password" class="form-control" name="password" value="{{ decrypt($identity->password) }}">
                @else
                	<input id="password" type="password" class="form-control" name="password" value="">
                @endif

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('secret_key') ? ' has-error' : '' }}">
            <label for="secret_key" class="col-md-4 control-label">Secret RSA Key (Optional)</label>

            <div class="col-md-6">   
                @if($identity->secret_key)
	                <span class="help-block">
	                    <strong>{{ $identity->secret_key }}</strong>
	                </span>
	            @else
	            	<span class="help-block">
	                    <strong>Not Set</strong>
	                </span>
                @endif

                @if ($errors->has('secret_key'))
                    <span class="help-block">
                        <strong>{{ $errors->first('secret_key') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('public_key') ? ' has-error' : '' }}">
            <label for="public_key" class="col-md-4 control-label">Public RSA Key (Optional)</label>

            <div class="col-md-6">
                @if($identity->public_key)
	                <span class="help-block">
	                    <strong>{{ $identity->public_key }}</strong>
	                </span>
	            @else
	            	<span class="help-block">
	                    <strong>Not Set</strong>
	                </span>
                @endif

                @if ($errors->has('public_key'))
                    <span class="help-block">
                        <strong>{{ $errors->first('public_key') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('identity_type') ? ' has-error' : '' }}">
        	<label for="identity_type" class="col-md-4 control-label">Identity Type</label>

        	<div class="col-md-6">
			  	<span class="help-block">
				  	@if($identity->identity_type == 1)
				  		<strong>Username and Password</strong>
				  	@else
				  		<strong>SSH Key</strong>
				  	@endif
			  	</span>

				@if ($errors->has('identity_type'))
                    <span class="help-block">
                        <strong>{{ $errors->first('identity_type') }}</strong>
                    </span>
                @endif
			</div>
		</div>

        <div class="form-group">
            <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Save
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
