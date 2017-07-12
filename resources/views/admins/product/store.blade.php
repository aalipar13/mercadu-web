@extends('admins.layouts.app')

@section('content')
<div class="container-fluid margin-top">    
    <div class="row">
        <div class="col-md-8 col-md-offset-4">
            {!! Form::open(['method' => 'POST', 'route' => ['admin.product.save'], 'files' => true,]) !!}
                <div class="form-group">
                    <h1>Create Product</h1>
                </div>
                <div class="form-group{{ $errors->has('store_id') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('store_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('store_id') }}</strong>
                                </span>
                            @endif
                            <label for="store_name" class="control-label">Store Name</label>
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
                            <label for="name" class="control-label">Product Name</label>
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Product Name'])!!}
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
                            <label for="description" class="control-label">Product Description</label>
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Product Description'])!!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('photo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('photo') }}</strong>
                                </span>
                            @endif
                            <label for="photo" class="control-label">Photo</label>
                            {!! Form::file('photo', null, array('class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @endif
                            <label for="type" class="control-label">Product Type</label>
                            {!! Form::select('type', ['simple' => 'Simple', 'group' => 'Group', 'external' => 'External', 'variable' => 'Variable'], null, ['class' => 'form-control', 'placeholder' => 'Type']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                            @endif
                            <label for="code" class="control-label">Product Code</label>
                            {!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Product Code'])!!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('quantity'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('quantity') }}</strong>
                                </span>
                            @endif
                            <label for="quantity" class="control-label">Quantity</label>
                            {!! Form::text('quantity', null, ['class' => 'form-control', 'placeholder' => 'Quantity'])!!}
                        </div>
                    </div>
                </div>
                {{-- <div class="form-group{{ $errors->has('min_quantity') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('min_quantity'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('min_quantity') }}</strong>
                                </span>
                            @endif
                            <label for="min_quantity" class="control-label">Minimum Quantity</label>
                            {!! Form::text('min_quantity', null, ['class' => 'form-control', 'placeholder' => 'Minimum Quantity'])!!}
                        </div>
                    </div>
                </div> --}}
                <div class="form-group{{ $errors->has('should_manage_stock') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('should_manage_stock'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('should_manage_stock') }}</strong>
                                </span>
                            @endif
                            <label for="should_manage_stock" class="control-label">Should Manage Stock?</label>
                            {!! Form::select('should_manage_stock', ['yes' => 'Yes', 'no' => 'No'], null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('available') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('available'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('available') }}</strong>
                                </span>
                            @endif
                            <label for="available" class="control-label">Available?</label>
                            {!! Form::select('available', ['yes' => 'Yes', 'no' => 'No'], null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('is_sold_individually') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('is_sold_individually'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('is_sold_individually') }}</strong>
                                </span>
                            @endif
                            <label for="is_sold_individually" class="control-label">Is Sold Individually?</label>
                            {!! Form::select('is_sold_individually', ['yes' => 'Yes', 'no' => 'No'], null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('regular_price') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('regular_price'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('regular_price') }}</strong>
                                </span>
                            @endif
                            <label for="regular_price" class="control-label">Regular Price</label>
                            {!! Form::text('regular_price', null, ['class' => 'form-control', 'placeholder' => 'Regular Price'])!!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('sale_price') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('sale_price'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('sale_price') }}</strong>
                                </span>
                            @endif
                            <label for="sale_price" class="control-label">Sale Price</label>
                            {!! Form::text('sale_price', null, ['class' => 'form-control', 'placeholder' => 'Sale Price'])!!}
                        </div>
                    </div>
                </div>
                {{-- sale_price_start_date_at --}}
                {{-- sale_price_end_date_at --}}
                <div class="form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('weight'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('weight') }}</strong>
                                </span>
                            @endif
                            <label for="weight" class="control-label">Weight</label>
                            {!! Form::text('weight', null, ['class' => 'form-control', 'placeholder' => 'Weight'])!!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('length') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('length'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('length') }}</strong>
                                </span>
                            @endif
                            <label for="length" class="control-label">Length</label>
                            {!! Form::text('length', null, ['class' => 'form-control', 'placeholder' => 'Length'])!!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('width') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('width'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('width') }}</strong>
                                </span>
                            @endif
                            <label for="width" class="control-label">Width</label>
                            {!! Form::text('width', null, ['class' => 'form-control', 'placeholder' => 'Width'])!!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('height') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('height'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('height') }}</strong>
                                </span>
                            @endif
                            <label for="height" class="control-label">Height</label>
                            {!! Form::text('height', null, ['class' => 'form-control', 'placeholder' => 'Height'])!!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('sort_order') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('sort_order'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('sort_order') }}</strong>
                                </span>
                            @endif
                            <label for="sort_order" class="control-label">Sort Order</label>
                            {!! Form::text('sort_order', null, ['class' => 'form-control', 'placeholder' => 'Sort Order'])!!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('purchase_note') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('purchase_note'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('purchase_note') }}</strong>
                                </span>
                            @endif
                            <label for="purchase_note" class="control-label">Purchase Note</label>
                            {!! Form::textarea('purchase_note', null, ['class' => 'form-control', 'placeholder' => 'Purchaser Note'])!!}
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('should_allow_reviews') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($errors->has('should_allow_reviews'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('should_allow_reviews') }}</strong>
                                </span>
                            @endif
                            <label for="should_allow_reviews" class="control-label">Should Allow Reviews?</label>
                            {!! Form::select('should_allow_reviews', ['yes' => 'Yes', 'no' => 'No'], null, ['class' => 'form-control']) !!}
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