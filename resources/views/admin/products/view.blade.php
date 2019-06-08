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
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <!-- Box-header -->
                <div class="box-header with-border">
                    <h3 class="box-title">View Product Details <b>(Total views : {{ $total_product_views }})</b></h3>
                    <a class="btn btn-info pull-right" href="/products">Back to list</a>
                </div>

                <!-- Box-body -->
                <div class="box-body">
                    <div class="panel-body">
                        <strong>Category :</strong> {{$product->category->name}}<br>
                        <strong>Name :</strong> {{$product->name}}<br>
                        <strong>SKU :</strong> {{$product->sku}}<br>
                        <strong>Price :</strong> £  {{$product->price}}<br>
                        <strong>Description :</strong> {{$product->description}}<br>
                        <strong>Created by :</strong> {{$product->user->name}}<br>
                        <strong>Created on :</strong> {{$product->created_at}}<br> <br> <br>
                        <strong><a class="" href="#" onclick="show_bids();">
                                <h3 class="btn btn-primary"><b>See Product Bid History </b></h3>
                            </a></strong>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</section>
<!-- /.Main content -->
@endsection