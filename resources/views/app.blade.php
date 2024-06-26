<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ setting('app_description') }}">

    <meta name="twitter:site" content="@preline">
    <meta name="twitter:creator" content="@htmlstream">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{ setting('app_name') }}">
    <meta name="twitter:description" content="{{ setting('app_description') }}">
    <meta name="twitter:image" content="{{ config('app.url') }}">

    <meta property="og:url" content="{{ config('app.url') }}">
    <meta property="og:site_name" content="{{ setting('app_name') }}">
    <meta property="og:title" content="{{ setting('app_name') }}">
    <meta property="og:description" content="{{ setting('app_description') }}">
    <meta property="og:image" content="{{ config('app.url') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Title -->
    <title inertia>{{ setting('app_name') }}</title>
    <!-- Favicon -->
    <link rel="icon" type="image/*" href="{{ asset(setting('favicon_icon')) }}" id="favicon" />
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Scripts -->
    @routes
    @vite('resources/js/app.js')
    @inertiaHead
    <style>
        html body {
            min-height: calc(100vh + 2px)
        }
        .width-100 {
            width: 100% !important;
        }
    </style>
</head>

<body class="font-sans antialiased" dir="{{ session()->get('current_dir') }}">
    @inertia
    <script src="/backend/preline/hs-ui.bundle.js"></script>
</body>

</html>
