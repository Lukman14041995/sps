<x-guest-layout>
    <div class="w-full max-w-md mx-auto mt-20 bg-white p-8 rounded-xl shadow-lg">

        <!-- LOGO -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('img/logo/sps_logo.png') }}" class="h-12" alt="SPS Logo">
        </div>

        <!-- TITLE -->
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">
            Login Admin
        </h2>
        <p class="text-center text-gray-500 mb-6">
            Masuk ke sistem manajemen SPS
        </p>

        <!-- ERROR -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <x-input-error :messages="$errors->get('email')" class="mb-2" />
        <x-input-error :messages="$errors->get('password')" class="mb-4" />

        <!-- FORM -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- EMAIL -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email
                </label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300"
                >
            </div>

            <!-- PASSWORD -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Password
                </label>
                <input
                    type="password"
                    name="password"
                    required
                    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300"
                >
            </div>

            <!-- REMEMBER -->
            <div class="flex items-center mb-6">
                <input type="checkbox" name="remember" class="mr-2">
                <span class="text-sm text-gray-600">Ingat saya</span>
            </div>

            <!-- BUTTON -->
            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition"
            >
                Login
            </button>
        </form>

    </div>
</x-guest-layout>
