@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Change Password</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ url('/ol/changepw/process') }}">
                        {{ csrf_field() }}

		        <!-- Current password -->
                        <div class="form-group{{ $errors->has('curpass') ? ' has-error' : '' }}">
                            <label for="curpass" class="col-md-4 control-label">Current Password</label>

                            <div class="col-md-6">
                                <input id="curpass" type="password" class="form-control" name="curpass" value="" required>

                                @if ($errors->has('curpass'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('curpass') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

		        <!-- New password -->
                        <div class="form-group{{ $errors->has('curpass') ? ' has-error' : '' }}">
                            <label for="curpass" class="col-md-4 control-label">New Password</label>

                            <div class="col-md-6">
                                <input id="newpass" type="password" class="form-control" name="newpass" value="" required>

                                @if ($errors->has('newpass'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('newpass') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

		        <!-- Confirm new password -->
                        <div class="form-group{{ $errors->has('curpass') ? ' has-error' : '' }}">
                            <label for="confnewpass" class="col-md-4 control-label">Confirm New Password</label>

                            <div class="col-md-6">
                                <input id="confnewpass" type="password" class="form-control" name="confnewpass" value="" required>

                                @if ($errors->has('confnewpass'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('confnewpass') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

			<!-- Submit button -->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Change Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
