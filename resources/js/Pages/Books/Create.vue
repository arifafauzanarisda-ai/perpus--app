<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';

// useForm membuat objek form yang otomatis mengelola nilai input dan pesan error
const form = useForm({
    kode_buku: '',
    judul: '',
    pengarang: '',
    penerbit: '',
    tahun: '',
    stok: 0,
});

// Dipanggil ketika tombol Simpan diklik
function submit() {
    // Mengirim data form ke route books.store, yaitu method store() pada BookController
    form.post(route('books.store'));
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="p-6">
            <h1 class="mb-4 text-2xl font-bold">Tambah Buku</h1>

            <!-- @submit.prevent mencegah reload halaman lalu menjalankan submit() -->
            <form @submit.prevent="submit" class="max-w-xl space-y-3 rounded bg-white p-6 shadow-sm">
                <div>
                    <label class="block text-sm font-medium">Kode Buku</label>
                    <input v-model="form.kode_buku" type="text" class="w-full rounded border-gray-300">
                    <span v-if="form.errors.kode_buku" class="text-sm text-red-600">{{ form.errors.kode_buku }}</span>
                </div>

                <div>
                    <label class="block text-sm font-medium">Judul</label>
                    <input v-model="form.judul" type="text" class="w-full rounded border-gray-300">
                    <span v-if="form.errors.judul" class="text-sm text-red-600">{{ form.errors.judul }}</span>
                </div>

                <div>
                    <label class="block text-sm font-medium">Pengarang</label>
                    <input v-model="form.pengarang" type="text" class="w-full rounded border-gray-300">
                    <span v-if="form.errors.pengarang" class="text-sm text-red-600">{{ form.errors.pengarang }}</span>
                </div>

                <div>
                    <label class="block text-sm font-medium">Penerbit</label>
                    <input v-model="form.penerbit" type="text" class="w-full rounded border-gray-300">
                    <span v-if="form.errors.penerbit" class="text-sm text-red-600">{{ form.errors.penerbit }}</span>
                </div>

                <div>
                    <label class="block text-sm font-medium">Tahun</label>
                    <input v-model="form.tahun" type="text" class="w-full rounded border-gray-300">
                    <span v-if="form.errors.tahun" class="text-sm text-red-600">{{ form.errors.tahun }}</span>
                </div>

                <div>
                    <label class="block text-sm font-medium">Stok</label>
                    <input v-model="form.stok" type="number" min="0" class="w-full rounded border-gray-300">
                    <span v-if="form.errors.stok" class="text-sm text-red-600">{{ form.errors.stok }}</span>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="rounded bg-gray-800 px-4 py-2 text-white hover:bg-gray-700 disabled:opacity-50"
                    >
                        Simpan
                    </button>
                    <Link href="/books" class="text-sm text-gray-600 hover:underline">Batal</Link>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
