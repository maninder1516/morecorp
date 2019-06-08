@extends('admin.common.layout')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Products</h1>   
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Products</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-info">
        <!-- Box-header -->
        <div class="box-header with-border">
            <h3 class="box-title">Edit Product</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>

            <!-- Errors-section -->
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <!-- /.Errors-section -->
        </div>
        <!-- /.Box-header -->

        <!-- Box-body -->
        <div class="box-body">
            <div class="row">
            {!!Form::open(array('url' => '/products/update/'.base_convert($product->id + 1000, 10, 36), 'class'=>'form-horizontal col-md-10 col-md-offset-1', 'id'=>'edit_product')) !!}
                <!-- Left Columns -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="col-md-3 control-label">Name <span class="requiredfield">*</span></label>
                        <div class="col-md-9">
                            {!! Form::text('name', $product->name, array('id'=>'name', 'placeholder'=>'Product name', 'class'=>'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-md-3 control-label">Price <span class="requiredfield">*</span></label>
                        <div class="col-md-9">
                            {!! Form::text('price', $product->price, array('id'=>'price', 'placeholder'=>'Price', 'class'=>'form-control')) !!}
                        </div>
                    </div>
                </div>
                <!-- Right Columns -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sku" class="col-md-3 control-label">Category <span class="requiredfield">*</span></label>
                        <div class="col-md-9">
                            {!! Form::select('category_id', $categories, $product->category_id, array('id'=>'category_id','placeholder'=>'Category','class'=>'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sku" class="col-md-3 control-label">SKU <span class="requiredfield">*</span></label>
                        <div class="col-md-9">
                            {!! Form::text('sku', $product->sku, array('id'=>'sku', 'placeholder'=>'SKU', 'class'=>'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-3 control-label">Description </label>
                        <div class="col-md-9">
                            {!! Form::textarea('description', $product->description, array('id'=>'description', 'placeholder'=>'Description', 'class'=>'form-control', 'rows'=>'1')) !!}
                        </div>
                    </div>
                    <div class="form-group box-footer">
                        <button class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-info" onclick="window.location ='{{ URL::to('/products') }}'">Cancel</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.box-body -->


    </div>
</section>
<!-- /.Main content -->
@endsection