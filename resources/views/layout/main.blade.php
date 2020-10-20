<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css" />
        @yield('styles')
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}" type="text/css" />
    </head>
    <body>
        @if(session()->has('flash_message'))
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            {{ session('flash_message') }}
        </div>
        @endif
        @yield('content')
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/popper.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        @yield('scripts')
    </body>
</html>