@extends('admins.layouts.app')

@section('content')
<div class="container-fluid margin-top">    
    @include('admins.common.flash')
    <div class="row">
        <div class="col-md-8 col-md-offset-4">
            {!! Form::open(['method' => 'PUT', 'route' => ['admin.tag-mapping.revise', $tagMapping['id']]]) !!}
                <div class="form-group">
                    <h1>Edit Tag Mapping</h1>
                </div>
                <div class="form-group{{ $errors->has('store_id') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('store_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('store_id') }}</strong>
                                </span>
                            @endif
                            <label for="store_id" class="control-label">Store Name</label>
                            {!! Form::select('store_id', $stores, $tagMapping['store_id'], ['class' => 'form-control store-name', 'placeholder' => 'Choose a Store']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('tag_id') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('tag_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tag_id') }}</strong>
                                </span>
                            @endif
                            <label for="tag_id" class="control-label">Tag Name</label>
                            {!! Form::select('tag_id', $tags, $tagMapping['tag_id'], ['class' => 'form-control tag-list', 'placeholder' => 'Choose a Tag']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('product_id') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('product_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('product_id') }}</strong>
                                </span>
                            @endif
                            <label for="product_id" class="control-label">Product Name</label>
                            {!! Form::select('product_id', $products, $tagMapping['product_id'], ['class' => 'form-control product-list', 'placeholder' => 'Choose a Product']) !!}
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