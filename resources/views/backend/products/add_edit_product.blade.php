@extends('backend.layout.app')
@section('title','Add Edit product')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Catalogues</h1>
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
      <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                 @endforeach
              </ul>
            </div>
        @endif
      	<form name="productForm" id="productForm" method="post" @if(empty($productdata['id'])) action="{{url('admin/add-edit-product')}}" @else action="{{url('admin/add-edit-product/'.$productdata['id'])}}" @endif enctype="multipart/form-data">
      	@csrf
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">{{$title}}</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
                <div class="col-md-6">
               	  <div class="form-group">
                    <label for="product_code">Product Code <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="product_code" id="product_code" placeholder="Enter Product Code" @if(!empty($productdata['product_code'])) value="{{$productdata['product_code']}}" @else value="{{old('product_code')}}" @endif>
                  </div>
                  </div>
                <div class="col-md-6">
              	  <div class="form-group">
                    <label for="product_name">Product Name <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Enter Product Name" @if(!empty($productdata['product_name'])) value="{{$productdata['product_name']}}" @else value="{{old('product_name')}}" @endif>
                  </div>
                </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="product_color">Product Color <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="product_color" id="product_color" placeholder="Enter Product Color" @if(!empty($productdata['product_color'])) value="{{$productdata['product_color']}}" @else value="{{old('product_color')}}" @endif>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                  	<label for="product_price">Product Price <span class="text-red">*</span></label>
                   <input type="text" class="form-control" name="product_price" id="product_price" placeholder="Enter Product Price" @if(!empty($productdata['product_price'])) value="{{$productdata['product_price']}}" @else value="{{old('product_price')}}" @endif>
                  </div>
                 </div>
                 <div class="col-md-6">
                  <div class="form-group">
                    <label for="main_image">Product Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input form-control" name="product_image" id="product_image">
                        <label class="custom-file-label" for="product_image">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
                    <small>Recomended Image Size 1000x1000</small>
                    @if(!empty($productdata['product_image']))
                    <div><img style="width:70px;" src="{{url('images/products/'.$productdata['product_image'])}}">
                    </div>
                    @endif
                  </div>
                </div>
              <!-- /.col -->
              </div><!-- /.row -->
             </div>
             <div class="card-footer">
             <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          </div>
       </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
