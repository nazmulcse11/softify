@extends('backend.layout.app')
@section('title','Order Details')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Order ID #{{ $orderDetails['id']}}</h1>
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
      <div class="container-fluid">
        @if(Session::has('success_message'))
          <div class="alert alert-success alert-dismissible fade show " role="alert">
            {{ Session::get('success_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Order Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <td>Order Date</td>
                      <td>{{ \Carbon\Carbon::parse($orderDetails['created_at'])->format('d/m/Y')}}</td>
                    </tr>
                    <tr>
                     <td>Order Status</td>
                     <td>{{ $orderDetails['order_status'] }}</td>
                   </tr>
                   <tr>
                     <td>Order Total</td>
                     <td>BDT {{ $orderDetails['total_price'] }}</td>
                   </tr>
                   <tr>
                     <td>Payment Method</td>
                     <td>{{ $orderDetails['payment_method'] }}</td>
                   </tr>
                   <tr>
                     <td>Payment Gateway</td>
                     <td>{{ $orderDetails['payment_gateway'] }}</td>
                   </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Shipping/Delivery Address</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <td>Name</td>
                      <td>{{ $orderDetails['name'] }}</td>
                    </tr>
                    <tr>
                     <td>Email</td>
                     <td>{{ $orderDetails['email'] }}</td>
                   </tr>
                   <tr>
                     <td>Phone</td>
                     <td>{{ $orderDetails['phone'] }}</td>
                   </tr>
                   <tr>
                     <td>Address</td>
                     <td>{{ $orderDetails['address'] }}</td>
                   </tr>
                   <tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Billing/User Address</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                     <td>Name</td>
                     <td>{{ $userDetails['name'] }}</td>
                   </tr>
                   <tr>
                     <td>Email</td>
                     <td>BDT {{ $userDetails['email'] }}</td>
                   </tr>
                   <tr>
                     <td>Phone</td>
                     <td>{{ $orderDetails['phone'] }}</td>
                   </tr>
                   <tr>
                    <td>Status</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Address</td>
                    <td></td>
                  </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Update Order Status</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <tbody>
                    <form action="{{ url('admin/update-order-status') }}" method="post">
                      @csrf
                      <tr>
                        <td colspan="2">
                          <input type="hidden" name="order_id" id="order_id" value="{{ $orderDetails['id'] }}">
                            <select name="update_status" id="update_status">
                              <option value="New">Select Status</option>
                              @foreach($orderStatuses as $status)
                              <option value="{{ $status['name'] }}" @if(isset($orderDetails['order_status']) && $orderDetails['order_status'] == $status['name']) selected="" @endif>{{ $status['name'] }}</option>
                              @endforeach
                            </select> &nbsp;&nbsp;
                            <button type="submit" class="btb btn-sm btn-primary">Update</button>
                        </td>
                      </tr>
                    </form>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Product Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Image</th>
                      <th>Code</th>
                      <th>Name</th>
                      <th>Color</th>
                      <th>Quantity</th>
                      <th>Unit Price</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($orderDetails['order_products'] as $product)
                    <tr>
                      <td>
                         <?php $getProductImage = App\Models\Product::select('product_image')->where(['id'=>$product['product_id']])->first(); ?>
                         <img style="width:80px;" src="{{ url('images/products/'.$getProductImage['product_image']) }}" alt="getProductImage">
                      </td>
                      <td>{{ $product['product_name'] }}</td>
                      <td>{{ $product['product_code'] }}</td>
                      <td>{{ $product['product_color'] }}</td>
                      <td>{{ $product['product_quantity'] }}</td>
                      <td>{{ $product['product_price'] }}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection