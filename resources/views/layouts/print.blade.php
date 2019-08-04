<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

        <title>{{ $pageTitle }}</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div>
              @yield('content')
            </div>
        </div>
    </body>
</html>
