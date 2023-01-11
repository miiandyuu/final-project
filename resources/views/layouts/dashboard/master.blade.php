<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('page-title') - {{ config('app.name', 'Laravel') }}</title>
  <link rel="stylesheet" href="{{ asset('dashboard/assets/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/assets/vendors/chartjs/Chart.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/assets/css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/universal.css') }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
  @livewireStyles
</head>

<body>
  <div id="app">
    @include('layouts.components.dashboard.sidebar')
    <div id="main">
      @include('layouts.components.dashboard.header')

      @yield('notification')

      <div class="main-content container-fluid">
        <div class="page-title">
          @yield('title')
        </div>
        <section class="section">
          @yield('content')
        </section>
      </div>
      
      @include('layouts.components.dashboard.footer')
    </div>
  </div>

  <script src="{{ asset('dashboard/assets/js/feather-icons/feather.min.js') }}"></script>
  <script src="{{ asset('dashboard/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('dashboard/assets/js/app.js') }}"></script>
  <script src="{{ asset('dashboard/assets/vendors/chartjs/Chart.min.js') }}"></script>
  <script src="{{ asset('dashboard/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('dashboard/assets/js/pages/dashboard.js') }}"></script>
  <script src="{{ asset('dashboard/assets/js/main.js') }}"></script>
  @yield('custom-javascript')
  @livewireScripts
</body>

</html>
