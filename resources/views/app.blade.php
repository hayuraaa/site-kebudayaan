<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  @class(['dark' => ($appearance ?? 'system') == 'dark'])>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Kebudayaan Wikimedia Indonesia') }}</title>

        <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/8/8d/Logo_Kebudayaan_WMID.svg" sizes="any">
        <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/8/8d/Logo_Kebudayaan_WMID.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="https://upload.wikimedia.org/wikipedia/commons/8/8d/Logo_Kebudayaan_WMID.svg">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
