<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin - SPS Corporate</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-700 text-white p-6">
            <h2 class="text-xl font-bold mb-8">SPS Admin</h2>
            <nav class="space-y-4">
                <a href="/admin/dashboard" class="block hover:underline">Dashboard</a>
                <a href="/admin/about" class="block hover:underline">About</a>
                <a href="/admin/business-units" class="block hover:underline">Business Units</a>
                <a href="/admin/news" class="block hover:underline">News</a>
                <a href="/admin/csr" class="block hover:underline">CSR</a>
                <a href="/admin/career" class="block hover:underline">Career</a>
            </nav>
        </aside>

        <!-- Content -->
        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>

</body>

</html>