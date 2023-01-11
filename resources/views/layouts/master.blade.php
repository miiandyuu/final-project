<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('page-title') - {{ config('app.name', 'Laravel') }}</title>
  <link rel="stylesheet" href="{{ asset('dashboard/assets/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/assets/css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/universal.css') }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
</head>

<body>
  <div id="app">
    @include('layouts.components.header')

    <main>
      @yield('content')
    </main>

    @include('layouts.components.footer')
  </div>

  <script src="{{ asset('dashboard/assets/js/feather-icons/feather.min.js') }}"></script>
  <script src="{{ asset('dashboard/assets/js/app.js') }}"></script>
  <script src="{{ asset('dashboard/assets/js/main.js') }}"></script>
  @yield('custom-javascript')
</body>

</html>
