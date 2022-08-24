<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel='shortcut icon' href="{{asset('storage/main/favicon.ico')}}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <title>@yield('title', 'Support : Unicepts')</title>
    <style>

        body{
            font-family: "Gill Sans", sans-serif;
        }

        .navbar {
            background: #f5f7f9;
        }

        .nav-item::after {
            content: '';
            display: block;
            width: 0px;
            height: 2px;
            background: #12344d;
            color: #010102;
            transition: 0.4s
        }

        .nav-item:hover::after {
            width: 100%
        }

        .navbar-light .navbar-nav .active>.nav-link,
        .navbar-light .navbar-nav .nav-link.active,
        .navbar-light .navbar-nav .nav-link.show,
        .navbar-light .navbar-nav .show>.nav-link,
        .navbar-light .navbar-nav .nav-link:focus,
        .navbar-light .navbar-nav .nav-link:hover {
            color: #010102;
            /* background: #12344d; */
            /* border-radius: 5px 5px 0px 0px; */
        }

        .nav-link {
            padding: 15px 5px;
            transition: 0.2s
        }

        .content{
            margin-top: 75px;
        }

    </style>
    @yield('styles')
  </head>
  <body>

    @include('layout.navbar')

    <div class="content">
        @yield('content')
    </div>

    @include('layout.footer')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
  </body>
</html>
