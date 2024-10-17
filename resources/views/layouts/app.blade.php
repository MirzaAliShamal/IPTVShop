<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="userId" content="{{ Auth::user()->id }}">
        <title>@yield('title') | IPTV Shop</title>

        <link rel="icon" href="{{ asset('app/images/iptv-shop-icon-32x32.png') }}" sizes="32x32" />
        <link rel="icon" href="{{ asset('app/images/iptv-shop-icon-192x192.png') }}" sizes="192x192" />
        <link rel="apple-touch-icon" href="{{ asset('app/images/iptv-shop-icon-180x180.png') }}" />
        <meta name="msapplication-TileImage" content="{{ asset('app/images/iptv-shop-icon-270x270.png') }}" />

        <link rel="stylesheet" href="{{ asset('app/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('app/css/sweetalert2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('app/css/style.css?v='.rand()) }}">
        <link rel="stylesheet" href="{{ asset('app/css/responsive.css?v='.rand()) }}">
        @yield('css')
        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/670a2fba4304e3196ad0a495/1i9vsksfu';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
            })();
        </script>
        <!--End of Tawk.to Script-->
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
        <script src="{{ asset('app/js/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('app/js/script.js?v='.rand()) }}"></script>

        @if (Session::has('success'))
            <script>
                Toast.fire({
                    icon: 'success',
                    title: '{{ session("success") }}'
                })
            </script>
        @endif

        @if (Session::has('error'))
            <script>
                Toast.fire({
                    icon: 'error',
                    title: '{{ session("error") }}'
                })
            </script>
        @endif
        
        @yield('js')
    </body>
</html>
