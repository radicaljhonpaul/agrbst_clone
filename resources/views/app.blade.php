<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ mix('css/sidebar.css') }}">
        <link rel="stylesheet" href="{{ mix('css/welcome.css') }}">
        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/jquery.min.js') }}" defer></script>
        <script src="{{ mix('js/moment.js') }}" defer></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
        
        <script src="{{ mix('js/plugins/easyinvoice.min.js') }}"></script>
        <script src="{{ mix('js/plugins/pdf.min.js') }}"></script>
        <script src="{{ mix('js/plugins/pdf.worker.min.js') }}"></script>
    </head>
    <body class="bg-light">
        @inertia

        <!-- {{-- @env ('local')
            <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
        @endenv --}} -->
    </body>


</html>
