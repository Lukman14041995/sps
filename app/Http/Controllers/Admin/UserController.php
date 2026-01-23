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
    // public function index()
    // {
    //     return view('admin.users.index', [
    //         'users' => User::with('roles')->latest()->paginate(10)
    //     ]);
    // }
    public function index()
    {
        // Data untuk tabel (paginated)
        $users = User::with('roles')
            ->latest()
            ->paginate(10);

        // Data untuk statistik (semua data)
        $totalUsers = User::count();
        $adminCount = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->count();

        $hrCount = User::whereHas('roles', function ($query) {
            $query->where('name', 'hr');
        })->count();

        $marketingCount = User::whereHas('roles', function ($query) {
            $query->where('name', 'marketing');
        })->count();

        return view('admin.users.index', [
            'users' => $users,
            'totalUsers' => $totalUsers,
            'adminCount' => $adminCount,
            'hrCount' => $hrCount,
            'marketingCount' => $marketingCount
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
            'must_change_password' => true,
        ]);

        $user->roles()->sync($request->roles);

        // Kirim email set password
        Password::sendResetLink([
            'email' => $user->email,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil dibuat');
    }

    // ✅ Tambahkan method edit
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    // ✅ Tambahkan method update
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'roles' => 'required|array',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $user->roles()->sync($request->roles);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    // ✅ Tambahkan method destroy
    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
