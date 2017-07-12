@extends('admins.layouts.app')

@section('content')
<div class="container-fluid margin-top">
    @include('admins.common.flash')
    <div class="row">
        <div class="col-md-4 col-md-offset-2">
            <h3>List of Tag Mapping</h3>
        </div>
        <div class="col-md-4">
            <div class="form-group pull-right">
                <a class="btn btn-success" href="{{ route('admin.tag-mapping.create') }}"><i class="fa fa-pencil"></i> Create</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (count($result) > 0)
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Store Name</th>
                        <th>Tag Name</th>
                        <th>Product Name</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($result as $tagMapping)
                          <tr>
                            <td>{{ $tagMapping['id'] }}</td>
                            <td>{{ $tagMapping['store']['name'] }}</td>
                            <td>{{ $tagMapping['tag']['name'] }}</td>
                            <td>{{ $tagMapping['product']['name'] }}</td>
                            <td>
                              <a class="btn btn-default" href="{{ route('admin.tag-mapping.show', ['id' => $tagMapping['id']]) }}"><i class="fa fa-search"></i> Show</a>
                              <a class="btn btn-primary" href="{{ route('admin.tag-mapping.edit', ['id' => $tagMapping['id']]) }}"><i class="fa fa-file-text-o"></i> Edit</a>
                              {!! Form::open(['method' => 'DELETE','route' => ['admin.tag-mapping.destroy', $tagMapping['id']],'style'=>'display:inline']) !!}
                                <button type="submit" name="delete-me" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash"></i> Delete</button>
                              {!! Form::close() !!}
                            </td>
                          </tr>
                          </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            @else
                There are no tag mapping records, <a href="{{ route('admin.tag-mapping.create') }}">create one?</a>
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
              <h6><strong>Do you want to delete this tag mapping?</strong></h6>
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