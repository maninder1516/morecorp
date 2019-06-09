<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>More Corp</title>

    <!-- Styles -->
    <style>
        html,
        body {
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

        .links>a {
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

    <!-- Custom styles for this template -->
    {!!Html::style('css/custom.css')!!}

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body>

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

    <div class="container ">
        <div class="well well-sm m-t-md">
            <strong>Product View</strong>
        </div>
        <div class="col-xs-4 item-photo">
            <img style="max-width:100%;" src="http://placehold.it/400x250/000/fff" />
        </div>
        <div class="col-xs-5" style="border:0px solid gray">
            <h3>{{ $product->name }}</h3>

            <!-- Precios -->
            <h6 class="title-price"><small>PRECIO OFERTA</small></h6>
            <h3 style="margin-top:0px;">$ {{ number_format($product->price, 2, '.', ',') }}</h3>

            <h5 style="color:#337ab7">Latest Bid Amount : $ {{ number_format($latest_bid_amt, 2, '.', ',') }}</h5>

            <div id="msg">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @endif
            </div>

            <div class="section">
                {!!Form::open(array('url' => '/placebid/'.base_convert($product->id + 1000, 10, 36),'class'=>'form-horizontal col-md-10 col-md-offset-1','id'=>'place_bid')) !!}

                <div class="form-group">
                    <label for="email" class="col-md-4 control-label">Email <span class="requiredfield">*</span></label>
                    <div class="col-md-6">
                        {!! Form::text('email','', array('id'=>'email','placeholder'=>'Email','class'=>'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="amount" class="col-md-4 control-label">Amount <span class="requiredfield">*</span></label>
                    <div class="col-md-6">
                        {!! Form::text('amount','', array('id'=>'amount','placeholder'=>'Amount','class'=>'form-control')) !!}
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success pull-right" style="margin-right:80px;"><span aria-hidden="true"></span>Place Bid</button>
                    <button type="button" class="btn btn-primary" onclick="window.location ='{{ URL::to('/') }}'">Back to Products</button>
                </div>


                {!! Form::close() !!}

            </div>
        </div>
        <div class="col-xs-9">
            <div style="width:100%;border-top:1px solid silver">
                <h3 class="title-price"><small>Product Description</small></h3>
                <p style="padding:15px;">
                    <small>
                        {{ $product->description }}
                    </small>
                </p>
            </div>
        </div>
    </div>
</body>

</html>