@extends('admins.layouts.app')

@section('content')
<div class="container-fluid margin-top">
    @include('admins.common.flash')
    <div class="row">
        <div class="col-md-offset-2 col-md-6">
            <h3>List of Users</h3>
        </div>
        <div class="col-md-offset-2 col-md-4">
            {!! Form::open(['method' => 'GET','route' => ['admin.user.search']]) !!}
              <div class="input-group">
                    {!! Form::text('keywords', isset($_GET['keywords']) ? $_GET['keywords'] : null, ['placeholder' => 'Search by name or mobile number', 'class' => 'form-control'])!!}
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </div>
              </div>
            {!! Form::close() !!}
        </div>
        <div class="col-md-4">
            <div class="form-group pull-right">
                <a class="btn btn-success" href="{{ route('admin.user.create') }}"><i class="fa fa-pencil"></i> Create</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (count($result) > 0)
                @if (count($result['userList']) > 0)
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Email</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Mobile</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($result['userList'] as $user)
                              <tr>
                                <td>{{ $user['id'] }}</td>
                                <td>{{ str_limit($user['email'], $limit = 20, $end = '...') }}</td>
                                <td>{{ str_limit($user['first_name'], $limit = 20, $end = '...') }}</td>
                                <td>{{ str_limit($user['last_name'], $limit = 20, $end = '...') }}</td>
                                <td>{{ $user['mobile'] }}</td>
                                <td>
                                  <a class="btn btn-default" href="{{ route('admin.user.show', ['id' => $user['id']]) }}"><i class="fa fa-search"></i> Show</a>
                                  <a class="btn btn-primary" href="{{ route('admin.user.edit', ['id' => $user['id']]) }}"><i class="fa fa-file-text-o"></i> Edit</a>
                                  {!! Form::open(['method' => 'DELETE','route' => ['admin.user.destroy', $user['id']],'style'=>'display:inline']) !!}
                                    <button type="submit" name="delete-me" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash"></i> Delete</button>
                                  {!! Form::close() !!}
                                </td>
                              </tr>
                              </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    @if(isset($result['paginate'])) {{$result['paginate']->links()}} @endif
                @else
                    No user found based on search.
                @endif
            @else
                There are no user records, <a href="{{ route('admin.user.create') }}">create one?</a>
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
              <h6><strong>Do you want to delete this user?</strong></h6>
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