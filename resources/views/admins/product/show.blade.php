@extends('admins.layouts.app')

@section('content')
<div class="container-fluid margin-top">    
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <label for="name" class="control-label">Product #{{$product['id']}}</label>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name" class="control-label">Product Name</label>
                                <div class="form-group">
                                    {{ $product['name'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="description" class="control-label">Product Description</label>
                                <div class="form-group">
                                    {{ $product['description'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="store_name" class="control-label">Store Name</label>
                                <div class="form-group">
                                    {{ $product['store_name'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="photo" class="control-label">Photo</label>
                        <img class="img-responsive" width="200" height="200" src="{{$product['photo']}}" />
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="type" class="control-label">Product Type</label>
                                <div class="form-group">
                                    {{ $product['type'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="code" class="control-label">Product Code</label>
                                <div class="form-group">
                                    {{ $product['code'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="quantity" class="control-label">Quantity</label>
                                <div class="form-group">
                                    {{ $product['quantity'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="min_quantity" class="control-label">Min Quantity</label>
                                <div class="form-group">
                                    {{ $product['min_quantity'] }}
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="should_manage_stock" class="control-label">Should Manage Stock</label>
                                <div class="form-group">
                                    {{ $product['should_manage_stock'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="available" class="control-label">Available</label>
                                <div class="form-group">
                                    {{ $product['available'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="is_sold_individually" class="control-label">Is Sold Individually</label>
                                <div class="form-group">
                                    {{ $product['is_sold_individually'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="regular_price" class="control-label">Regular Price</label>
                                <div class="form-group">
                                    {{ $product['regular_price'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="sale_price" class="control-label">Sale Price</label>
                                <div class="form-group">
                                    {{ $product['sale_price'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="weight" class="control-label">Weight</label>
                                <div class="form-group">
                                    {{ $product['weight'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="length" class="control-label">Length</label>
                                <div class="form-group">
                                    {{ $product['length'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="width" class="control-label">Width</label>
                                <div class="form-group">
                                    {{ $product['width'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="height" class="control-label">Height</label>
                                <div class="form-group">
                                    {{ $product['height'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="sort_order" class="control-label">Sort Order</label>
                                <div class="form-group">
                                    {{ $product['sort_order'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="purchase_note" class="control-label">Purchase Note</label>
                                <div class="form-group">
                                    {{ $product['purchase_note'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="should_allow_reviews" class="control-label">Should Allow Reviews</label>
                                <div class="form-group">
                                    {{ $product['should_allow_reviews'] }}
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