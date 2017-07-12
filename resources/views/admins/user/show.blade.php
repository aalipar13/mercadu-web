@extends('admins.layouts.app')

@section('content')
<div class="container-fluid margin-top">    
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <label for="name" class="control-label">User #{{$user['id']}}</label>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="email" class="control-label">Email</label>
                                <div class="form-group">
                                    {{ $user['email'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="first_name" class="control-label">First Name</label>
                                <div class="form-group">
                                    {{ $user['first_name'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="last_name" class="control-label">Last Name</label>
                                <div class="form-group">
                                    {{ $user['last_name'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="mobile" class="control-label">Mobile</label>
                                <div class="form-group">
                                    {{ $user['mobile'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="birth_date" class="control-label">Birthdate</label>
                                <div class="form-group">
                                    {{ $user['birth_date'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection