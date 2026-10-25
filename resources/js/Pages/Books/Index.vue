<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, usePage } from '@inertiajs/vue3';

// Menerima data buku dari BookController@index
defineProps({
    books: Object,
});

// Pesan sukses dari redirect di BookController@store (dibagikan lewat HandleInertiaRequests)
const page = usePage();
</script>

<template>
    <AuthenticatedLayout>
        <div class="p-6">
            <h1 class="mb-4 text-2xl font-bold">Data Buku</h1>

            <!-- Pesan sukses setelah data berhasil disimpan -->
            <div
                v-if="page.props.flash?.success"
                class="mb-4 rounded border border-green-300 bg-green-100 px-4 py-2 text-green-800"
            >
                {{ page.props.flash.success }}
            </div>

            <!-- Tombol menuju halaman tambah buku -->
            <Link
                href="/books/create"
                class="mb-4 inline-block rounded bg-gray-800 px-4 py-2 text-white hover:bg-gray-700"
            >
                + Tambah Buku
            </Link>

            <!-- Tabel data buku -->
            <table class="mt-4 w-full border-collapse bg-white text-left">
                <thead>
                    <tr class="border-b bg-gray-50">
                        <th class="px-3 py-2">Kode</th>
                        <th class="px-3 py-2">Judul</th>
                        <th class="px-3 py-2">Pengarang</th>
                        <th class="px-3 py-2">Stok</th>
                    </tr>
                </thead>

                <tbody>
                    <!-- Menampilkan setiap data buku -->
                    <tr
                        v-for="book in books.data"
                        :key="book.id"
                        class="border-b"
                    >
                        <td class="px-3 py-2">{{ book.kode_buku }}</td>
                        <td class="px-3 py-2">{{ book.judul }}</td>
                        <td class="px-3 py-2">{{ book.pengarang }}</td>
                        <td class="px-3 py-2">{{ book.stok }}</td>
                    </tr>

                    <!-- Pesan jika belum ada data buku -->
                    <tr v-if="books.data.length === 0">
                        <td colspan="4" class="px-3 py-4 text-center text-gray-500">
                            Belum ada data buku.
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Navigasi paginasi: 10 data per halaman -->
            <div class="mt-4 flex items-center justify-between text-sm">
                <Link
                    v-if="books.prev_page_url"
                    :href="books.prev_page_url"
                    class="rounded border px-3 py-1 hover:bg-gray-100"
                >
                    &larr; Sebelumnya
                </Link>
                <span v-else class="px-3 py-1 text-gray-400">&larr; Sebelumnya</span>

                <span class="text-gray-600">
                    Halaman {{ books.current_page }} dari {{ books.last_page }}
                </span>

                <Link
                    v-if="books.next_page_url"
                    :href="books.next_page_url"
                    class="rounded border px-3 py-1 hover:bg-gray-100"
                >
                    Berikutnya &rarr;
                </Link>
                <span v-else class="px-3 py-1 text-gray-400">Berikutnya &rarr;</span>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
