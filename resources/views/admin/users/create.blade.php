@extends('admin.layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-semibold mb-4">Tambah User</h1>

    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium">Nama</label>
            <input name="name" required class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Email</label>
            <input name="email" type="email" required class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Role</label>
            @foreach($roles as $role)
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="roles[]" value="{{ $role->id }}">
                    <span>{{ $role->name }}</span>
                </label>
            @endforeach
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Simpan & Kirim Aktivasi
        </button>
    </form>
</div>
@endsection
