<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="min-vh-100" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | برنامه آموزشی دانشگاه</title>
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js'])

    @yield('style')
</head>

<body class="bg-light">
    <div id="app">
        @include('layouts.header')

        <main class="py-4 min-vh-100 @if (!in_route(['register', 'login'])) row row-cols-2 m-0 @endif" style="padding-top: 4.5rem !important">
            @if (!in_route(['register', 'login']))
                <div class="col-2 bg-primary shadow d-none d-md-block" style="border-radius: 50px 0 0 50px">
                    @include('layouts.sidemenu')
                </div>
                <div class="card col-11 col-md-9 mx-auto shadow px-0" style="border-radius: 50px; overflow: hidden;">
                    <div class="card-header px-4 text-bg-primary">
                        @yield('title')
                    </div>
                    <div class="card-body bg-primary-subtle">
                        @yield('content')
                    </div>
                    <div class="card-footer text-bg-primary" dir="ltr">
                        @if (isset($pagination_items))
                            {{ $pagination_items->links() }}
                        @endif
                    </div>
                </div>
            @else
                @yield('content')
            @endif

        </main>
    </div>

    @yield('script')
    @yield('modal-script')
</body>

</html>
