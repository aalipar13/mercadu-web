@extends('admins.layouts.app')

@section('content')
<div class="container-fluid margin-top">
    @include('admins.common.flash')
    <div class="row">
        <div class="col-md-4 col-md-offset-2">
            <h3>Search for Orders</h3>
        </div>
        {!! Form::open(['method' => 'GET', 'route' => ['admin.order.search']]) !!}
          <div class="form-group">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    {!! Form::label('date', 'Date', array('class' => 'col-md-1 control-label date-label')) !!}
                    {!! Form::text('date', isset($result['data']['date']) ? $result['data']['date'] : null, ['class' => 'datepicker'] ) !!}
                </div>
            </div>
          </div>
          <div class="form-group">
              <div class="row">
                  <div class="col-sm-offset-2 col-sm-5">
                      {!! Form::submit('Search', array('class' => 'btn btn-primary search-btn')) !!}
                  </div>
              </div>
          </div>
        {!! Form::close() !!}
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (isset($result['pendingOrders']) && count($result['pendingOrders']) > 0)
                <div><b>PENDING ORDERS  (Total amount: {{'&#8369; ' . number_format($result['pendingOrdersTotal'], 2)}})</b></div>
                <br>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Product</th>
                        <th>Customer Name</th>
                        <th>Mobile #</th>
                        <th>Total Amount</th>
                        <th>Discount</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($result['pendingOrders'] as $order)
                        <tr>
                            <td>{!!$order['id']!!}</td>
                            <td>{!!$order['order_name_summary']!!}</td>
                            <td>{!!$order['user_name']!!}</td>
                            <td>+63 - {!!$order['user_mobile']!!}</td>
                            <td>{!!'&#8369; ' . number_format($order['total_amount'], 2)!!}</td>
                            <td>&#8369; {{empty($order['total_discount']) ? '0.00' : number_format($order['total_discount'],2)}}</td>
                            <td>
                                {!! Form::open(['method' => 'PUT', 'route' => ['admin.order.update-to-delivered', $order['id']], 'style'=>'display:inline']) !!}
                                  <button type="submit" name="update-me" class="btn btn-success" data-toggle="modal" data-target="#confirm-update"><i class="fa fa-check"></i> Deliver</button>
                                {!! Form::close() !!}
                                {!! Form::open(['method' => 'PUT', 'route' => ['admin.order.update-to-cancelled', $order['id']], 'style'=>'display:inline']) !!}
                                  <button type="submit" name="update-me" class="btn btn-danger" data-toggle="modal" data-target="#confirm-update"><i class="fa fa-times"></i> Cancel</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (isset($result['deliveredOrders']) && count($result['deliveredOrders']) > 0)
                <div><b>DELIVERED ORDERS (Total amount: {{'&#8369; ' . number_format($result['deliveredOrdersTotal'], 2)}})</b></div>
                <br>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Product</th>
                        <th>Customer Name</th>
                        <th>Mobile #</th>
                        <th>Total Amount</th>
                        <th>Discount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($result['deliveredOrders'] as $order)
                        <tr>
                            <td>{!!$order['id']!!}</td>
                            <td>{!!$order['order_name_summary']!!}</td>
                            <td>{{$order['user_detail']['first_name'] . ' ' . $order['user_detail']['last_name']}}</td>
                            <td>+63 - {{$order['user_detail']['mobile']}}</td>
                            <td>{{'&#8369; ' . number_format($order['total_amount'], 2)}}</td>
                            <td>&#8369; {{empty($order['total_discount']) ? '0.00' : number_format($order['total_discount'],2)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (isset($result['cancelledOrders']) && count($result['cancelledOrders']) > 0)
                <div><b>CANCELLED ORDERS (Total amount: {{'&#8369; ' . number_format($result['cancelledOrdersTotal'], 2)}})</b></div>
                <br>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Product</th>
                        <th>Customer Name</th>
                        <th>Mobile #</th>
                        <th>Total Amount</th>
                        <th>Discount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($result['cancelledOrders'] as $order)
                        <tr>
                            <td>{!!$order['id']!!}</td>
                            <td>{!!$order['order_name_summary']!!}</td>
                            <td>{{$order['user_detail']['first_name'] . ' ' . $order['user_detail']['last_name']}}</td>
                            <td>+63 - {{$order['user_detail']['mobile']}}</td>
                            <td>{{'&#8369; ' . number_format($order['total_amount'], 2)}}</td>
                            <td>&#8369; {{empty($order['total_discount']) ? '0.00' : number_format($order['total_discount'],2)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    <!-- Confirmation modal -->
      <div id="confirm-update" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title" id="myModalLabel2">Update Status</h4>
            </div>
            <div class="modal-body">
              <h6><strong>Do you want to update the status of this order?</strong></h6>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
              <button type="button" class="btn btn-danger" id="update">Yes</button>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection