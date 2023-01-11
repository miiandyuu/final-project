<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('is_admin');

        $idLogin = Auth::id();
        $allUserExpectLogin = User::where('id', '<>', $idLogin)->get();
        $adminAvailable = User::where('role', '=', 'admin')->get();

        return view('dashboard.user.index', compact(['allUserExpectLogin', 'adminAvailable']));
    }

    public function create()
    {
        $this->authorize('is_admin');

        return view('dashboard.user.create');
    }

    public function store(Request $request)
    {
        $this->authorize('is_admin');

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'regex:(anggota|staff|admin)'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        if ($user) {
            return redirect()
                ->route('user.index')
                ->with([
                    'success' => 'User berhasil dibuat'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'User gagal dibuat'
                ]);
        }
    }

    public function edit($id)
    {
        $this->authorize('is_admin');

        $user = User::findOrFail($id);
        return view('dashboard.user.edit', compact(['user']));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('is_admin');

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'role' => ['required', 'string', 'regex:(anggota|staff|admin)'],
        ]);

        $user = User::findOrFail($id);

        if (!is_null($request->password)) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role
            ]);
        }

        if ($user) {
            return redirect()
                ->route('user.index')
                ->with([
                    'success' => 'User berhasil diubah'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'User gagal diubah'
                ]);
        }
    }

    public function destroy($id)
    {
        $this->authorize('is_admin');

        $user = User::findOrFail($id);
        $user->delete();

        if ($user) {
            return redirect()
                ->route('user.index')
                ->with([
                    'success' => 'User berhasil dihapus'
                ]);
        } else {
            return redirect()
                ->route('user.index')
                ->with([
                    'error' => 'User gagal dihapus'
                ]);
        }
    }
}
