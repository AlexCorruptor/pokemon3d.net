<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') - {{ env('APP_NAME') }}</title>

        <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">

        <!-- Style -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        @production
            <script defer data-domain="{{ request()->getHost() }}" src="https://plausible.io/js/plausible.js"></script>
        @endproduction
    </head>
<body class="w-full h-screen font-sans antialiased bg-top bg-repeat bg-woods">
    <div class="container flex items-center justify-center flex-1 h-full mx-auto">
        <div class="w-full max-w-lg">

            @if (session('error'))
                <div class="px-4 py-3 mb-4 leading-normal text-red-100 bg-red-700 rounded-lg">
                    <i class="mr-2 fas fa-frown" aria-hidden="true"></i> {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="px-4 py-3 mb-4 leading-normal text-green-100 bg-green-700 rounded-lg">
                    <i class="mr-2 fas fa-check-circle" aria-hidden="true"></i> {{ session('success') }}
                </div>
            @endif
            @if (session('info'))
                <div class="px-4 py-3 mb-4 leading-normal text-blue-100 bg-blue-700 rounded-lg">
                    <i class="mr-2 fas fa-info-circle" aria-hidden="true"></i> {{ session('info') }}
                </div>
            @endif
            @if (session('warning'))
                <div class="px-4 py-3 leading-normal text-yellow-100 bg-yellow-700 rounded-lg">
                    <i class="mr-2 fas fa-exclamation" aria-hidden="true"></i> {{ session('warning') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="px-4 py-3 mb-4 leading-normal text-yellow-100 bg-yellow-700 rounded-lg" role="alert">
                    <strong><i class="mr-2 fas fa-exclamation-triangle" aria-hidden="true"></i> Input Warning</strong>
                    <ul class="m-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        
            @yield('content')
        </div>

    </div>
    
    @include('cookieConsent::index')
    
    @yield('javascript')

</body>
</html>