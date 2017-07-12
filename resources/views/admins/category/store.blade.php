@extends('admins.layouts.app')

@section('content')
<div class="container-fluid margin-top">    
    <div class="row">
        <div class="col-md-8 col-md-offset-4">
            {!! Form::open(['method' => 'POST', 'route' => ['admin.category.save']]) !!}
                <div class="form-group">
                    <h1>Create Category</h1>
                </div>
                <div class="form-group{{ $errors->has('store_id') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('store_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('store_id') }}</strong>
                                </span>
                            @endif
                            <label for="name" class="control-label">Store Name</label>
                            {!! Form::select('store_id', $stores, null, ['class' => 'form-control', 'placeholder' => 'Choose a Store']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            <label for="name" class="control-label">Category Name</label>
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Category Name'])!!}
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
                            <label for="description" class="control-label">Category Description</label>
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Category Description'])!!}
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