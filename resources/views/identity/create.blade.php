@extends('layouts.app')

@section('content')
<div class="panel-heading">
    Create a New Identity
</div>

<div class="panel-body">
    <form class="form-horizontal" role="form" method="POST" action="{{ route('identities.store') }}" enctype="multipart/form-data">
        
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Identity Name</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

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
                <input id="user" type="text" class="form-control" name="user" value="{{ old('user') }}" required>

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
                <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}">

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
                <input id="secret_key" type="file" class="form-control" name="secret_key" value="{{ old('secret_key') }}">

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
                <input id="public_key" type="file" class="form-control" name="public_key" value="{{ old('public_key') }}">

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
		        <select id="identity_type" class="form-control" name="identity_type" value="{{ old('identity_type') }}" required>
				  	<option value="0">SSH Key</option>
				  	<option value="1">Username and Password</option>
				</select>

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
