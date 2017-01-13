@extends('layouts.app')

@section('content')
<div class="panel-heading">
    Create a New Server
</div>

<div class="panel-body">
    <form class="form-horizontal" role="form" method="POST" action="{{ route('servers.store') }}">
        
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Server Name</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('ip') ? ' has-error' : '' }}">
            <label for="ip" class="col-md-4 control-label">IP Address</label>

            <div class="col-md-6">
                <input id="ip" type="text" class="form-control" name="ip" value="{{ old('ip') }}" required autofocus>

                @if ($errors->has('ip'))
                    <span class="help-block">
                        <strong>{{ $errors->first('ip') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('identity_id') ? ' has-error' : '' }}">
            <label for="identity_id" class="col-md-4 control-label">Identity</label>

            <div class="col-md-6">
                <select id="identity_id" class="form-control" name="identity_id" required>
                    <option>-- Select an Identity --</option>
                    @foreach($identities as $identity)
                        <option value="{{ $identity->id }}">{{ $identity->name }}</option>
                    @endforeach
                </select>

                @if ($errors->has('identity_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('identity_id') }}</strong>
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
