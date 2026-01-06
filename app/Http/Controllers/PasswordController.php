<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    /**
     * Tampilkan form ganti password
     */
    public function form()
    {
        return view('auth.change-password');
    }

    /**
     * Simpan password baru
     */
    public function update(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = auth()->user();

        $user->update([
            'password' => Hash::make($request->password),
            'must_change_password' => false,
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Password berhasil diperbarui');
    }
}
