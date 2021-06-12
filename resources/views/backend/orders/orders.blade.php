@extends('backend.layout.app')
@section('title','Orders')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Orders</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Orders</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
     <section class="content">
      <div class="row">
        <div class="col-12">
          @if(Session::has('success_message'))
          <div class="alert alert-success alert-dismissible fade show " role="alert">
            {{ Session::get('success_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Products</h3>
              <a class="btn btn-primary btn-sm float-right" href="{{url('/admin/add-edit-product')}}">Add Product</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="sections" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Product Code</th>
                  <th>Status</th>
                  <th>Pay Method</th>
                  <th>Pay Gateway</th>
                  <th>Details</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $key=>$order)
                <tr>
                  <td>{{ $order['id'] }}</td>
                  <td>{{ $order['name'] }}</td>
                  <td>{{ $order['email'] }}</td>
                  <td>
                     @foreach($order['order_products'] as $pro )
                     {{ $pro['product_code']}} ({{ $pro['product_quantity']}}) <br>
                     @endforeach
                  </td>
                  <td>{{ $order['order_status'] }}</td>
                  <td>{{ $order['payment_method'] }}</td>
                  <td>{{ $order['payment_gateway'] }}</td>
                  <td>
                    <a title="Edit Product" class="text-primary" href="{{ url('admin/order-details/'.$order['id']) }}"><i class="fa fa-eye"></i></a>
                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Order ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Pay Method</th>
                  <th>Pay Gateway</th>
                  <th>Details</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection