<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Learning Management system</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mdb-pro.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <div id="app">
        <header>
            @include('partials.nav')
            @if (Auth::check() && Auth::user()->role == 'admin')
                @include('partials.admin.sidebar')
            @elseif (Auth::check() && Auth::user()->role == 'instructor')
                @include('partials.instructor.sidebar')
            @elseif (Auth::check() && Auth::user()->role == 'student')
                @include('partials.student.sidebar')        
            @endif

        </header>

        <main class="admin">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/mdb.min.js') }}"></script>
    <script>
        // SideNav Button Initialization
        $(".button-collapse").sideNav();
        // SideNav Scrollbar Initialization
        var sideNavScrollbar = document.querySelector('.custom-scrollbar');
        Ps.initialize(sideNavScrollbar);

        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    @yield('script')
</body>
</html>
