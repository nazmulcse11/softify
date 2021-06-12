@extends('backend.layout.app')
@section('title','Products')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Products</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
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
                  <th>No</th>
                  <th>Product Name</th>
                  <th>Product Code</th>
                  <th>Product Stock</th>
                  <th>Product Color</th>
                  <th>Product Image</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $key=>$product)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$product->product_name}}</td>
                  <td>{{$product->product_code}}</td>
                  <td>{{$product->product_stock}}</td>
                  <td>{{$product->product_color}}</td>
                   <td> 
                    <?php $product_image_path = 'images/products/'.$product->product_image;?>
                    @if(!empty($product->product_image) && file_exists($product_image_path))
                    <img style="width:50px;" src="{{url('images/products/'.$product->product_image)}}">
                    @else
                    <img style="width:50px;" src="{{url('images/products/no-image.png')}}">
                    @endif
                  </td>
                  <td style="width:120px">
                    <a title="Edit Product" class="text-warning" href="{{url('admin/add-edit-product/'.$product->id)}}"><i class="fa fa-edit"></i></a>
                    <a title="Delete Product" class="confirmDelete text-danger" record ="product" recordid="{{$product->id}}" href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Product Name</th>
                  <th>Product code</th>
                  <th>Product Color</th>
                  <th>Product Image</th>
                  <th>Action</th>
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