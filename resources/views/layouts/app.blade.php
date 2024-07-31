<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('title') | IPTV Shop</title>

        <link rel="icon" href="{{ asset('app/images/iptv-shop-icon-32x32.png') }}" sizes="32x32" />
        <link rel="icon" href="{{ asset('app/images/iptv-shop-icon-192x192.png') }}" sizes="192x192" />
        <link rel="apple-touch-icon" href="{{ asset('app/images/iptv-shop-icon-180x180.png') }}" />
        <meta name="msapplication-TileImage" content="{{ asset('app/images/iptv-shop-icon-270x270.png') }}" />

        <link rel="stylesheet" href="{{ asset('app/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('app/css/style.css?v='.rand()) }}">
        <link rel="stylesheet" href="{{ asset('app/css/responsive.css?v='.rand()) }}">
        @yield('css')
    </head>
    <body data-side-minimize="off">
        <div class="d-flex flex-column" id="wrapper">
            <div class="d-flex flex-column flex-root">
                <div class="d-flex flex-row flex-column-fluid">
                    @include('app.components.sidebar')

                    <div class="page-wrapper d-flex flex-column flex-row-fluid">
                        @include('app.components.header')

                        <div class="content-wrapper d-flex flex-column-fluid">
                            <div class="container">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="post" id="logout-form">@csrf</form>

        <script src="{{ asset('app/js/jquery.js') }}"></script>
        <script src="{{ asset('app/js/popper.min.js') }}"></script>
        <script src="{{ asset('app/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('app/js/script.js?v='.rand()) }}"></script>
        @yield('js')
    </body>
</html>
