<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::with('roles')->latest()->get()
        ]);
    }

    public function create()
    {
        return view('admin.users.create', [
            'roles' => Role::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'roles' => 'required|array',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('$$admin$$'),
    'must_change_password' => true, // 🔥 penting
        ]);

        $user->roles()->sync($request->roles);

        // Kirim email set password
        Password::sendResetLink([
            'email' => $user->email,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil dibuat & email aktivasi dikirim.');
    }
}
