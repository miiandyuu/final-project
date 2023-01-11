@if (session('success'))
  <div class="alert alert-light-success color-success mx-4">
    <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none"
      stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
      <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
      <polyline points="22 4 12 14.01 9 11.01"></polyline>
    </svg> {{ session('success') }}
  </div>
@endif

@if (session('error'))
  <div class="alert alert-light-danger color-danger mx-4">
    <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none"
      stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
      <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
      <line x1="12" y1="9" x2="12" y2="13"></line>
      <line x1="12" y1="17" x2="12.01" y2="17"></line>
    </svg> {{ session('error') }}
  </div>
@endif
