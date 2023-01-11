@extends('layouts.dashboard.master')

@section('page-title', 'User Index')

@section('notification')
  @include('layouts.partial.notification')
@endsection

@section('title')
  <h4 class="text-center mb-3">User</h4>
@endsection

@section('content')
  <section class="header-menu">
    <div class="card m-0 border border-bottom-0 shadow-none">
      <div class="card-body d-flex align-items-center justify-content-between">
        <p class="m-0">Halaman User</p>
        <a href="{{ route('user.create') }}"><button class="btn btn-success">Tambah User</button></a>
      </div>
    </div>
  </section>
  <!-- table bordered -->
  <div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
      <thead>
        <tr>
          <th class="text-center">Nama</th>
          <th class="text-center">E-mail</th>
          <th class="text-center">Role</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody class="bg-white">
        @foreach ($allUserExpectLogin as $user)
          <tr>
            <td>{{ ucwords($user->name) }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>
              <div class="d-flex justify-content-around">
                {{-- Update --}}
                <a href="{{ route('user.edit', $user->id) }}" class="me-3">
                  <i class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="edit"></i>Ubah
                </a>
                {{-- Delete --}}
                @if ( ($user->role == 'admin') && (count($adminAvailable) <= 1) )
                @else
                <form onsubmit="return confirm('Ingin Menghapus User {{ ucwords($user->name) }} ?');"
                  action="{{ route('user.destroy', $user->id) }}" method="POST">
                  @csrf
                  @method('DELETE')

                  <button type="submit" class="bg-transparent border-0 text-danger">
                    <i class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="trash"></i>Hapus
                  </button>
                </form>
                @endif
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
