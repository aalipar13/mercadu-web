@extends('admins.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <ul class="list-group">
                  <li class="list-group-item"><a href="{{ route('store.index') }}">Stores</a></li>
                  <li class="list-group-item"><a href="{{ route('category.index') }}">Categories</a></li>
                  <li class="list-group-item"><a href="{{ route('tag.index') }}">Tags</a></li>
                  <li class="list-group-item"><a href="{{ route('product.index') }}">Products</a></li>
                  <li class="list-group-item"><a href="{{ route('tag-mapping.index') }}">Tag Mappings</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection