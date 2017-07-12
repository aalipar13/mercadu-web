@extends('admins.layouts.app')

@section('content')
<div class="container-fluid margin-top">    
    @include('admins.common.flash')
    <div class="row">
        <div class="col-md-8 col-md-offset-4">
            {!! Form::open(['method' => 'PUT', 'route' => ['admin.user.revise', $user['id']]]) !!}
                <div class="form-group">
                    <h1>Edit User</h1>
                </div>
                <input type="hidden" name="user_id" value="{{ $user['userdetails_id'] }}">
                <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @endif
                            <label for="type" class="control-label">Choose a User Type</label>
                            {!! Form::select('type', ['user' => 'User', 'admin' => 'Admin'], $user['type'], ['class' => 'form-control', 'placeholder' => 'Choose a Type']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('first_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                            <label for="first_name" class="control-label">First Name</label>
                            {!! Form::text('first_name', $user['first_name'], ['class' => 'form-control', 'placeholder' => 'First Name'])!!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('last_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                            @endif
                            <label for="last_name" class="control-label">Last Name</label>
                            {!! Form::text('last_name', $user['last_name'], ['class' => 'form-control', 'placeholder' => 'Last Name'])!!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('mobile'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mobile') }}</strong>
                                </span>
                            @endif
                            <label for="mobile" class="control-label">Mobile</label>
                            {!! Form::text('mobile', $user['mobile'], ['class' => 'form-control', 'placeholder' => 'Mobile'])!!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('birth_date') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('birth_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('birth_date') }}</strong>
                                </span>
                            @endif
                            <label for="birth_date" class="control-label">Birth Date</label>
                            {!! Form::text('birth_date', $user['birth_date'], ['class' => 'form-control', 'placeholder' => 'Birth Date'])!!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('is_account_verified') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('is_account_verified'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('is_account_verified') }}</strong>
                                </span>
                            @endif
                            <label for="is_account_verified" class="control-label">Is account verified?</label>
                            {!! Form::select('is_account_verified', ['yes' => 'Yes', 'no' => 'No'], $user['is_account_verified'], ['class' => 'form-control', 'placeholder' => 'Is account verified?']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('has_subscribe_newsletter') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('has_subscribe_newsletter'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('has_subscribe_newsletter') }}</strong>
                                </span>
                            @endif
                            <label for="has_subscribe_newsletter" class="control-label">Has subscribe to newsletter?</label>
                            {!! Form::select('has_subscribe_newsletter', ['yes' => 'Yes', 'no' => 'No'], $user['has_subscribe_newsletter'], ['class' => 'form-control', 'placeholder' => 'Has subscribe to newsletter?']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            <label for="email" class="control-label">Email</label>
                            {!! Form::text('email', $user['email'], ['class' => 'form-control', 'placeholder' => 'Email'])!!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('current_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('current_password') }}</strong>
                                </span>
                            @endif
                            <label for="current_password" class="control-label">Current Password</label>
                            {!! Form::password('current_password', ['class' => 'form-control', 'placeholder' => 'Current Password']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            <label for="password" class="control-label">New Password</label>
                            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'New Password']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                            <label for="password_confirmation" class="control-label">Confirm Password</label>
                            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-lg text-bold text-uppercase" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection