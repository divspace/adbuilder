<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{ $title }}</title>
        <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-light bg-faded">
                <a class="navbar-brand" href="{{ url('/') }}">{{ $title }}</a>
            </nav>
        </div>
        <div class="container">
            @yield('content')
        </div>
        <div class="container">
            <footer>
                Copyright &copy; {{ $date }} <a href="http://mediasolutionscorp.com">{{ $company }}</a>.
            </footer>
        </div>
        <script src="{{ asset('assets/js/app.js') }}"></script>
        @yield('script')
    </body>
</html>
