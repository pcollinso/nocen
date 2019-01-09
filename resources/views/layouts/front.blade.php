<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link href="{{ asset('css/front.css') }}" rel="stylesheet" type="text/css">

        <script src="/assets_front/plugins/pace/pace.min.js"></script>
    </head>
    <body data-spy="scroll" data-target="#header" data-offset="51">
      <div id="page-container" class="fade">
        @yield('content')
      </div>
      <!--[if lt IE 9]>
        <script src="/assets_front/crossbrowserjs/html5shiv.js"></script>
        <script src="/assets_front/crossbrowserjs/respond.min.js"></script>
        <script src="/assets_front/crossbrowserjs/excanvas.min.js"></script>
      <![endif]-->
      <script type="text/javascript" src="{{ asset('js/manifest.js') }}"></script>
      <script type="text/javascript" src="{{ asset('js/vendor.js') }}"></script>
      <script src="{{ asset('js/front.js') }}"></script>
      <script src="/assets_front/plugins/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
      <script src="/assets_front/plugins/scrollMonitor/scrollMonitor.js"></script>
      <script src="/assets_front/plugins/paroller/jquery.paroller.min.js"></script>
      <script src="/assets_front/js/one-page-parallax/apps.min.js"></script>
      <!-- ================== END BASE JS ================== -->

      <script>
        $(document).ready(function() {
          App.init();
        });
      </script>
    </body>
</html>
