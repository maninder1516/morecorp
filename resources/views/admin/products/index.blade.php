@extends('admin.common.layout')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
        	<div class="box">
                <!-- Box-header -->
        		<div class="box-header">
                    <h3 class="box-title">Products</h3>
                    <span class="col-md-offset-4"><a class="pull-right mb-10" href="{{ URL::to('products/add') }}"><h3 class="btn btn-primary"><b>New Product </b></h3></a></span>
                </div>
                <!-- /.Box-header -->

                <!-- Box-body -->
                <div class="box-body">
                    <table id="tbl_products" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Created By</th>
                                <th class="txtcolor text-center" text-alignment='center'>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>£ {{ number_format($product->price, 2, '.', ',') }}</td>
                                <td>{{ str_limit($product->description, $limit = 25, $end = '...') }}</td>
                                <td>{{ $users[$product->created_by] }}</td>
                                <td>
                                    <a class="btn" href="{{ URL::to('products/edit/'.base_convert($product->id + 1000, 10, 36) ) }}" title="Edit"><i class="fa fa-edit"></i></a>
                                    <a class="btn" href="{{ URL::to('products/delete/'.base_convert($product->id + 1000, 10, 36) ) }}" title="Delete" onClick="return confirm('Are you sure you want to delete this record ?')"><i class="fa fa-trash-o" style="color:red"></i></a>
                                    <a class="btn" href="{{ URL::to('products/view/'.base_convert($product->id + 1000, 10, 36) ) }}" title="View"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="notfound"> No record found </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div>{!! $products->links() !!}</div>
                </div>
                <!-- /.Box-body -->

            </div>
        </div>
    </div>
</section>
<!-- /.Main content -->
@endsection