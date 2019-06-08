<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MintM</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                /* align-items: center; */
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 25px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .m-t-md {
                margin-top: 50px;
            }
        </style>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">{{ __('messages.home') }}</a>
                    @else
                        <a href="{{ route('login') }}">{{ __('messages.login') }}</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">{{ __('messages.register') }}</a>
                        @endif
                    @endauth
                </div>
            @endif
            

            <div class="container">
                <div class="well well-sm m-t-md">
                    <strong>Category Title - Products</strong>
                </div>
                <div id="products" class="row list-group">
                    @forelse($products as $product)
                    <div class="item  col-xs-4 col-md-4">
                        <div class="thumbnail">
                            <img class="group list-group-image" src="{{asset('img/sample-product.png')}}" alt="" />
                            <div class="caption">
                                <h4 class="group inner list-group-item-heading">
                                    {{ $product->name }}</h4>
                                <p class="group inner list-group-item-text">
                                    {{ $product->description }}.</p>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <p class="lead">
                                            $ {{ number_format($product->price, 2, '.', ',') }}</p>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <a class="btn btn-success" href="{{ URL::to('productview/'.base_convert($product->id + 1000, 10, 36)) }}">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="7" class="notfound"> No record found </td>
                    </tr>
                    @endforelse
                </div>
                <div>{!! $products->links() !!}</div>
            </div>
        </div>
    </body>
</html>
