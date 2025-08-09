<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ $settings->favicon ?? asset('logo.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ $settings->favicon ?? asset('logo.png') }}" type="image/x-icon">
    <title>{{ $settings->name ?? '' }} Election Portal - @yield('title')</title>
    <meta name="description" content="{{ $settings->name ?? '' }} Election Portal" />

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/js/app.js', 'resources/css/app.css'])
  </head>
  <body class="text-slate-900 dark:text-slate-100">
    <div id="app" class="min-h-screen app-bg">
        @yield('content')
    </div>
</body>
</html>
