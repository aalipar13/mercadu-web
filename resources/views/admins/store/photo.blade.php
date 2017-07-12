@extends('admins.layouts.app')

@section('content')
<div class="container-fluid margin-top">    
    <div class="row">
        <div class="col-md-8 col-md-offset-3">
            <div class="form-group">
                <h1>Edit Store Photos</h1>
            </div>
            @if (count($store['store_photo']) > 0)
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Photo</th>
                        <th>Update Photo</th>
                        <th>Delete Photo</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($store['store_photo'] as $photo)
                          <tr>
                            <td class="store-img">
                                <img class="img-responsive" width="200px" height="200px" src="{{$photo['photo']}}" />
                            </td>
                            <td>
                              {!! Form::open(['method' => 'PUT', 'route' => ['admin.store-photo.revise', $photo['id']], 'files' => true]) !!}
                                    <div class="store-photos {{ $errors->has('updatePhoto.*') ? ' has-error' : '' }}">
                                        @if ($errors->has('updatePhoto.*'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('updatePhoto.*') }}</strong>
                                            </span>
                                        @endif
                                        {!! Form::file('updatePhoto[0]', array('class' => 'photos-update')) !!}
                                    </div>
                                    <button type="submit" name="update" class="btn btn-primary btn-update" disabled="disabled"><i class="fa fa-file-text-o"></i> Update</button>
                              {!! Form::close() !!}
                            </td>
                            <td>
                                {!! Form::open(['method' => 'DELETE','route' => ['admin.store-photo.destroy', $photo['id']],'style'=>'display:inline']) !!}
                                    <button type="submit" name="delete-me" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash"></i> Delete</button>
                                {!! Form::close() !!}
                            </td>
                          </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            @else
                There are no photos of the store.
            @endif
            <hr>
            {!! Form::open(['method' => 'POST', 'route' => ['admin.store-photo.save', $store['id']], 'files' => true, 'enctype'=>'multipart/form-data']) !!}
                Add a New Photo
                <div class="store-photos {{ $errors->has('addPhoto.*') ? ' has-error' : '' }}">
                    <div class="store-photos">
                        @if ($errors->has('addPhoto.*'))
                            <span class="help-block">
                                <strong>{{ $errors->first('addPhoto.*') }}</strong>
                            </span>
                        @endif
                        {!! Form::file('addPhoto[0]', array('class' => 'store-file photos-add')) !!}
                    </div>
                    <button type="submit" name="update" class="btn btn-success btn-add" disabled="disabled"><i class="fa fa-pencil"></i> Add</button>
                </div>
            {!! Form::close() !!}
        </div>
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
        <h6><strong>Do you want to delete this store photo?</strong></h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-danger" id="delete">Yes</button>
      </div>
    </div>
  </div>
</div>
@endsection