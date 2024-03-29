<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Not Found - {{ config('app.name', 'Laravel') }}</title>
  <link rel="stylesheet" href="{{ asset('dashboard/assets/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/assets/css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/universal.css') }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
</head>

<body>
  <div id="error">
    <div class="container text-center pt-32">
      <h1 class="error-title">404</h1>
      <p>Tidak dapat menemukan halaman yang dicari.</p>
      <a href="{{ route('homepage.index') }}" class='btn btn-primary'>Go Home</a>
      <a href="{{ route('dashboard.index') }}" class='btn btn-primary ms-3'>Go Dashboard</a>
    </div>

    <div class="footer pt-32">
      <p class="m-0">Skripsi Ricky Aston</p>
    </div>
  </div>
</body>

</html>
