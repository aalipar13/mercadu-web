@extends('admins.layouts.app')

@section('content')
<div class="container-fluid margin-top">
    @include('admins.common.flash')
    <div class="row">
        <div class="col-md-4 col-md-offset-2">
            <h3>List of Stores</h3>
        </div>
        <div class="col-md-4">
            <div class="form-group pull-right">
                <a class="btn btn-success" href="{{ route('admin.store.create') }}"><i class="fa fa-pencil"></i> Create</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (count($result['storeList']) > 0)
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($result['storeList'] as $store)
                          <tr>
                            <td>{{ $store['id'] }}</td>
                            <td>{{ $store['name'] }}</td>
                            <td>{{ str_limit($store['description'], $limit = 20, $end = '...') }}</td>
                            <td>
                              <a class="btn btn-default" href="{{ route('admin.store.show', ['id' => $store['id']]) }}"><i class="fa fa-search"></i> Show</a>
                              <a class="btn btn-primary" href="{{ route('admin.store.edit', ['id' => $store['id']]) }}"><i class="fa fa-file-text-o"></i> Edit</a>
                              {!! Form::open(['method' => 'DELETE','route' => ['admin.store.destroy', $store['id']],'style'=>'display:inline']) !!}
                                <button type="submit" name="delete-me" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash"></i> Delete</button>
                              {!! Form::close() !!}
                              <a class="btn btn-warning" href="{{ route('admin.store-photo.photos', ['id' => $store['id']]) }}"><i class="fa fa-file-image-o"></i> Photos</a>
                            </td>
                          </tr>
                          </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                @if(isset($result['paginate'])) {{$result['paginate']->links()}} @endif
            @else
                There are no store records, <a href="{{ route('admin.store.create') }}">create one?</a>
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
              <h6><strong>Do you want to delete this store?</strong></h6>
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