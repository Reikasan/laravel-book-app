<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Book App{{ isset($title) ? ' ' . $title : null }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap" rel="stylesheet">
        
        <!-- Favicon -->
        <link rel=”shortcut icon” href="{{ asset('favicon.ico') }}" />
       
        <!-- Script -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/fbe614a2b2.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <x-navbar />
        <div class="container {{ isset($containerClass) ? $containerClass : null }}">
            {{ $slot }}
        </div>
        @if(session('success'))
        <x-toast-notification type="success" message="{{session('success')}}"/>
        @elseif($errors->any())
            @foreach($errors->all() as $error)
            <x-toast-notification type="error" message="{{$errors->any()}}"/>
            @endforeach
        @endif
    </body>
</html>