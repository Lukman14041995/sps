@extends('admin.layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-16 bg-white p-6 rounded-lg shadow">

    <h2 class="text-xl font-bold mb-4 text-center">
        Ganti Password
    </h2>

    <p class="text-sm text-gray-600 text-center mb-6">
        Demi keamanan, silakan ganti password Anda terlebih dahulu.
    </p>

    {{-- ERROR --}}
    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
            <ul class="text-sm list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.change.update') }}">
        @csrf

        {{-- PASSWORD BARU --}}
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">
                Password Baru
            </label>
            <input
                type="password"
                name="password"
                required
                class="w-full border px-3 py-2 rounded focus:outline-none focus:ring"
            >
        </div>

        {{-- KONFIRMASI --}}
        <div class="mb-6">
            <label class="block text-sm font-medium mb-1">
                Konfirmasi Password
            </label>
            <input
                type="password"
                name="password_confirmation"
                required
                class="w-full border px-3 py-2 rounded focus:outline-none focus:ring"
            >
        </div>

        <button
            type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded font-semibold"
        >
            Simpan Password
        </button>

    </form>
</div>
@endsection
