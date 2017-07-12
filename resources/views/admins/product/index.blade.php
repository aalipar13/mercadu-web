@extends('admins.layouts.app')

@section('content')
<div class="container-fluid margin-top">
    @include('admins.common.flash')
    <div class="row">
        <div class="col-md-4 col-md-offset-2">
            <h3>List of Products</h3>
        </div>
        <div class="col-md-4">
            <div class="form-group pull-right">
                <a class="btn btn-success" href="{{ route('admin.product.create') }}"><i class="fa fa-pencil"></i> Create</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (count($result['productList']) > 0)
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Store Name</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($result['productList'] as $product)
                          <tr>
                            <td>{{ $product['id'] }}</td>
                            <td>{{ $product['name'] }}</td>
                            <td>{{ str_limit($product['description'], $limit = 20, $end = '...') }}</td>
                            <td>{{ $product['store_name'] }}</td>
                            <td>
                              <a class="btn btn-default" href="{{ route('admin.product.show', ['id' => $product['id']]) }}"><i class="fa fa-search"></i> Show</a>
                              <a class="btn btn-primary" href="{{ route('admin.product.edit', ['id' => $product['id']]) }}"><i class="fa fa-file-text-o"></i> Edit</a>
                              {!! Form::open(['method' => 'DELETE','route' => ['admin.product.destroy', $product['id']],'style'=>'display:inline']) !!}
                                <button type="submit" name="delete-me" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash"></i> Delete</button>
                              {!! Form::close() !!}
                            </td>
                          </tr>
                          </tr>
                      @endforeach
                    </tbody>
                  </table>
                  @if(isset($result['paginate'])) {{$result['paginate']->links()}} @endif
                </div>
            @else
                There are no product records, <a href="{{ route('admin.product.create') }}">create one?</a>
            @endif
        </div>
    </div>
    <!-- Delete modal -->
      <div id="confirm-delete" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title" id="myModalLabel2">Delete</h4>
            </div>
            <div class="modal-body">
              <h6><strong>Do you want to delete this product?</strong></h6>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
              <button type="button" class="btn btn-danger" id="delete">Yes</button>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection