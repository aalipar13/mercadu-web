@extends('admins.layouts.app')

@section('content')
<div class="container-fluid margin-top">    
    <div class="row">
        <div class="col-md-8 col-md-offset-4">
            {!! Form::open(['method' => 'POST', 'route' => ['admin.store.save'], 'files' => true]) !!}
                <div class="form-group">
                    <h1>Create Store</h1>
                </div>
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            <label for="name" class="control-label">Store Name</label>
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Store Name'])!!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                            <label for="description" class="control-label">Store Description</label>
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Store Description'])!!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('store_img') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('store_img'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('store_img') }}</strong>
                                </span>
                            @endif
                            <label for="store_img" class="control-label">Store Image</label>
                            {!! Form::file('store_img', null, array('class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('photo.*') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('photo.*'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('photo.*') }}</strong>
                                </span>
                            @endif
                            <label for="photo-label" class="control-label">Photos</label>
                            <div class="input_fields_wrap">
                                <button class="add_field_button">Add More Fields</button>
                                <div class="store-photos">
                                    {!! Form::file('photo[0]', array('class' => 'col-md-8 store-file')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-lg text-bold text-uppercase" type="submit">Create</button>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection