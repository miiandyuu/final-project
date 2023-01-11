@extends('layouts.master')

@section('page-title', 'Login')

@section('content')
  <div id="auth">
    <div class="container">
      <div class="row">
        <div class="col-md-5 col-sm-12 mx-auto">
          <div class="card pt-4">
            <div class="card-body">
              <div class="text-center mb-5">
                <img src="{{ asset('images/icon-saham.png') }}" alt="Logo Saham" width="120px" class="mb-3">
                <h3>Login</h3>
                <p>Silahkan Login untuk melanjutkan ke aplikasi.</p>
              </div>
              <form action="{{ route('login') }}" method="POST">
                @csrf
                <div>
                  <label for="email">E-Mail</label>
                  <div class="form-group position-relative has-icon-left">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                      name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <div class="form-control-icon">
                      <i data-feather="mail"></i>
                    </div>
                  </div>
                  @error('email')
                    @include('layouts.partial.invalid-form', ['message' => $message])
                  @enderror
                </div>
                <div>
                  <label for="password">Password</label>
                  <div class="form-group position-relative has-icon-left">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                      name="password" required autocomplete="current-password" placeholder="Minimum 8 Character">
                    <div class="form-control-icon">
                      <i data-feather="lock"></i>
                    </div>
                  </div>
                  @error('password')
                    @include('layouts.partial.invalid-form', ['message' => $message])
                  @enderror
                </div>

                <div class="divider">
                  <div class="divider-text">
                    <a href="{{ route('register') }}">Tidak Punya Akun? Register</a>
                  </div>
                </div>
                <div class="clearfix">
                  <button class="btn btn-primary float-end">Login</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
