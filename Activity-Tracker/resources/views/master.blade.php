<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/all.css')}}">
    <script src="{{asset('assets/js/bootstrap.bundle.js')}}"></script>
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/master-style.css') }}" />
    <title>Activity Tracker</title>
</head>
@yield('internal-style')
</head>
<body>
    <!-- Nav Includes start -->
    @include('layouts.nav')
    <!-- Nav Includes End -->
    <div class="container-wrapper">
        <!-- Content Section start-->
        @yield('site-content')
        <!-- Content Section End-->
    </div>
    <!-- Footer Includes start -->
    @include('layouts.footer')
    <!-- Footer Includes End -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    
</body>
</html>
