<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    {{-- sass e javascript --}}
    @vite(['resources/sass/app.scss', 'resource/js/app.js'])
</head>
<body>
    @yield('content')
    
</body>
</html>