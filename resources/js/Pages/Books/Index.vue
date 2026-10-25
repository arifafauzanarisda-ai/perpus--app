<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';
// 'ref' baru ditambahkan: dipakai untuk menyimpan ketikan pengguna pada kotak pencarian

const props = defineProps({
    books: Object,
    search: String, // menerima kata kunci terakhir yang dikirim dari Langkah 7
});

// Nilai awal kotak pencarian diisi dari props.search, bukan selalu kosong
const keyword = ref(props.search);

// Function baru: dijalankan saat pengguna menekan Enter pada kotak pencarian
function cari() {
    // router.get mengarahkan ke /books dengan tambahan ?search=..., memicu index() di Langkah 7
    router.get('/books', { search: keyword.value });
}

function hapus(id) {
    if (confirm('Yakin ingin menghapus buku ini?')) {
        router.delete(route('books.destroy', id));
    }
}
</script>

<template>
    <AuthenticatedLayout>
        <h1>Data Buku</h1>

        <!-- Flash message baru: $page.props.flash tersedia karena Langkah 5 -->
        <div v-if="$page.props.flash.success">
            {{ $page.props.flash.success }}
        </div>

        <Link href="/books/create">+ Tambah Buku</Link>

        <!-- Enter memanggil cari() -->
        <input
            v-model="keyword"
            @keyup.enter="cari"
            type="text"
            placeholder="Cari judul atau pengarang..."
        >

        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                    <!-- kolom baru untuk tombol Edit dan Hapus -->
                </tr>
            </thead>
            <tbody>
                <tr v-for="book in books.data" :key="book.id">
                    <td>{{ book.kode_buku }}</td>
                    <td>{{ book.judul }}</td>
                    <td>{{ book.pengarang }}</td>
                    <td>{{ book.stok }}</td>
                    <td>
                        <!-- Link menuju form edit, mengarah ke Books/Edit.vue (Langkah 3) -->
                        <Link :href="`/books/${book.id}/edit`">Edit</Link>
                        <!-- @click memanggil function hapus() yang baru ditambahkan di atas -->
                        <button @click="hapus(book.id)">Hapus</button>
                    </td>
                </tr>

                <!-- Pesan jika tidak ada data (atau hasil pencarian kosong) -->
                <tr v-if="books.data.length === 0">
                    <td colspan="5" class="text-center text-gray-500">
                        Tidak ada data buku.
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Navigasi paginasi: 10 data per halaman, kata kunci pencarian ikut terbawa -->
        <div class="mt-4 flex items-center justify-between">
            <Link
                v-if="books.prev_page_url"
                :href="books.prev_page_url"
                class="rounded border px-3 py-1 hover:bg-gray-100"
            >
                &larr; Sebelumnya
            </Link>
            <span v-else class="px-3 py-1 text-gray-400">&larr; Sebelumnya</span>

            <span class="text-sm text-gray-600">
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
    </AuthenticatedLayout>
</template>