@extends('admin.layouts.app')

@section('title', 'Contact Messages')

@section('content')
    <div class="px-6 py-6 w-full">

        {{-- ===== HEADER ===== --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Contact Messages
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Daftar pesan yang masuk dari halaman Contact
                </p>
            </div>
        </div>

        {{-- ===== TABLE CARD ===== --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden w-full">

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Subject</th>
                            <th class="px-6 py-4">Message</th>
                            <th class="px-6 py-4">Date</th>
                            <th class="px-6 py-4 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y dark:divide-gray-700">
                        {{-- SAMPLE STATIC (GANTI DENGAN LOOP NANTI) --}}
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/40 transition">
                            <td class="px-6 py-4">1</td>
                            <td class="px-6 py-4 font-medium text-gray-800 dark:text-white">
                                John Doe
                            </td>
                            <td class="px-6 py-4">john@mail.com</td>
                            <td class="px-6 py-4">Kerjasama</td>
                            <td class="px-6 py-4 max-w-xs truncate">
                                Ingin bekerjasama untuk project CSR...
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-500">
                                2026-01-22
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button
                                    class="inline-flex items-center px-4 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs">
                                    <i class="fas fa-eye mr-1"></i> Detail
                                </button>
                            </td>
                        </tr>

                        {{-- EMPTY STATE --}}
                        {{--
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-gray-400">
                            Belum ada pesan masuk
                        </td>
                    </tr>
                    --}}
                    </tbody>
                </table>
            </div>

        </div>

    </div>
@endsection
