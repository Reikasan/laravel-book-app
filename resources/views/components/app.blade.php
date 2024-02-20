<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Book App{{ isset($title) ? ' ' . $title : null }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
       
        <!-- Favicon -->
        <link rel=”shortcut icon” href="{{ asset('favicon.ico') }}" />
       
        <!-- Script -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        <x-navbar />
        <div class="container {{ isset($containerClass) ? $containerClass : null }}">
            {{ $slot }}
        </div>
    </body>
</html>