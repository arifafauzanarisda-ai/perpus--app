<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <aside
        class="flex min-h-screen w-64 flex-shrink-0 flex-col bg-gray-800 p-4 text-white"
    >
        <!-- Judul Sidebar -->
        <h2 class="mb-6 border-b border-gray-700 pb-4 text-lg font-bold">
            Perpustakaan Mini
        </h2>

        <!-- Navigasi -->
        <nav class="space-y-2">
            <Link
                href="/dashboard"
                class="block rounded-lg px-3 py-2 transition duration-200 hover:bg-gray-700 hover:text-gray-300"
            >
                Dashboard
            </Link>

            <Link
                href="/"
                class="block rounded-lg px-3 py-2 transition duration-200 hover:bg-gray-700 hover:text-gray-300"
            >
                Beranda
            </Link>

            <!-- Menu daftar buku, href sama dengan Route::resource('books') -->
            <Link
                href="/books"
                class="block rounded-lg px-3 py-2 transition duration-200 hover:bg-gray-700 hover:text-gray-300"
            >
                Data Buku
            </Link>
        </nav>
    </aside>
</template>
