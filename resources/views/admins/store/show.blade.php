@extends('admins.layouts.app')

@section('content')
<div class="container-fluid margin-top">    
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <label for="name" class="control-label">Store #{{$store['id']}}</label>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name" class="control-label">Store Name</label>
                                <div class="form-group">
                                    {{ $store['name'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="description" class="control-label">Store Description</label>
                                <div class="form-group">
                                    {{ $store['description'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="photo" class="control-label">Store Image</label>
                        <img class="img-responsive" width="200" height="200" src="{{$store['store_img']}}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection