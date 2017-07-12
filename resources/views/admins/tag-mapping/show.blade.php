@extends('admins.layouts.app')

@section('content')
<div class="container-fluid margin-top">    
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <label for="name" class="control-label">Tag Mapping #{{$tagMapping['id']}}</label>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name" class="control-label">Store Name</label>
                                <div class="form-group">
                                    {{ $tagMapping['store_name'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name" class="control-label">Tag Name</label>
                                <div class="form-group">
                                    {{ $tagMapping['tag_name'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name" class="control-label">Product Name</label>
                                <div class="form-group">
                                    {{ $tagMapping['product_name'] }}
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