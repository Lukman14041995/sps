@extends('admin.layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between mb-4">
        <h1 class="text-xl font-bold">User Management</h1>
        <a href="{{ route('admin.users.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">
            + Tambah User
        </a>
    </div>

    <table class="w-full bg-white rounded shadow">
        <thead>
            <tr class="border-b">
                <th class="p-3 text-left">Nama</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="border-b">
                <td class="p-3">{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection