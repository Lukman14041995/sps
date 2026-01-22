@extends('admin.layouts.app')

@section('content')
<div class="bg-gray-900 min-h-screen py-10">

    <div class="bg-gray-800 p-6 max-w-2xl mx-auto rounded-lg shadow">

        <h1 class="text-2xl font-semibold text-white mb-6">Edit User</h1>

        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div class="mb-5">
                <label class="block text-sm text-gray-300 mb-1">Nama *</label>
                <input name="name" value="{{ old('name', $user->name) }}" required
                       class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>

            {{-- Email --}}
            <div class="mb-5">
                <label class="block text-sm text-gray-300 mb-1">Email *</label>
                <input name="email" type="email" value="{{ old('email', $user->email) }}" required
                       class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>

            {{-- Role --}}
            <div class="mb-6">
                <label class="block text-sm text-gray-300 mb-2">Role</label>

                <div class="space-y-2">
                    @foreach($roles as $role)
                        <label class="flex items-center space-x-2 text-gray-200">
                            <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                   {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'checked' : '' }}
                                   class="rounded bg-gray-700 border-gray-600 text-blue-600 focus:ring-blue-600">
                            <span>{{ $role->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Button --}}
            <div class="flex justify-between items-center">
                <a href="{{ route('admin.users.index') }}" class="text-gray-300 hover:text-white">
                    ← Kembali
                </a>

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                    Update User
                </button>
            </div>

        </form>

    </div>

</div>
@endsection
