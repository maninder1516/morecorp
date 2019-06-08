@extends('admin.common.layout')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Missions</h1>   
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Missions</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-info">
        <!-- Box-header -->
        <div class="box-header with-border">
            <h3 class="box-title">Add New Product</h3>
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
                {!!Form::open(array('url' => '/products/create/','class'=>'form-horizontal col-md-10 col-md-offset-1','id'=>'add_product')) !!}
                <!-- Left Columns -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="col-md-3 control-label">Name <span class="requiredfield">*</span></label>
                        <div class="col-md-9">
                            {!! Form::text('name','', array('id'=>'name','placeholder'=>'Product name','class'=>'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-md-3 control-label">Price <span class="requiredfield">*</span></label>
                        <div class="col-md-9">
                            {!! Form::text('price','', array('id'=>'price','placeholder'=>'Price','class'=>'form-control')) !!}
                        </div>
                    </div>
                </div>
                <!-- Right Columns -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sku" class="col-md-3 control-label">Category <span class="requiredfield">*</span></label>
                        <div class="col-md-9">
                            {!! Form::select('category_id', $categories, array('id'=>'category_id','placeholder'=>'Category','class'=>'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sku" class="col-md-3 control-label">SKU <span class="requiredfield">*</span></label>
                        <div class="col-md-9">
                            {!! Form::text('sku','', array('id'=>'sku','placeholder'=>'SKU','class'=>'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-3 control-label">Description </label>
                        <div class="col-md-9">
                            {!! Form::textarea('description','', array('id'=>'description','placeholder'=>'Description','class'=>'form-control', 'rows'=>'1')) !!}
                        </div>
                    </div>
                    <div class="form-group box-footer">
                        <button class="btn btn-primary">Save</button>
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