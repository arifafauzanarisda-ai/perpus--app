<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

// Menerima data buku dari BookController@edit
const props = defineProps({
    book: Object,
});

// Mengisi formulir dengan data buku yang sudah ada
const form = useForm({
    kode_buku: props.book.kode_buku,
    judul: props.book.judul,
    pengarang: props.book.pengarang,
    penerbit: props.book.penerbit ?? '',
    tahun: props.book.tahun ?? '',
    stok: props.book.stok,
});

// Mengirim perubahan data buku
function submit() {
    form.put(route('books.update', props.book.id));
}
</script>

<template>
    <Head title="Edit Buku" />

    <AuthenticatedLayout>
        <div class="mx-auto max-w-3xl">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">
                    Edit Buku
                </h1>

                <p class="mt-1 text-gray-600">
                    Ubah informasi buku sesuai kebutuhan.
                </p>
            </div>

            <div class="rounded-lg bg-white p-6 shadow-sm">
                <form @submit.prevent="submit" class="space-y-5">
                    <!-- Kode Buku -->
                    <div>
                        <label class="mb-1 block font-medium text-gray-700">
                            Kode Buku
                        </label>

                        <input
                            v-model="form.kode_buku"
                            type="text"
                            class="w-full rounded-md border border-gray-300 p-3"
                            required
                        />

                        <p
                            v-if="form.errors.kode_buku"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.kode_buku }}
                        </p>
                    </div>

                    <!-- Judul Buku -->
                    <div>
                        <label class="mb-1 block font-medium text-gray-700">
                            Judul Buku
                        </label>

                        <input
                            v-model="form.judul"
                            type="text"
                            class="w-full rounded-md border border-gray-300 p-3"
                            required
                        />

                        <p
                            v-if="form.errors.judul"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.judul }}
                        </p>
                    </div>

                    <!-- Pengarang -->
                    <div>
                        <label class="mb-1 block font-medium text-gray-700">
                            Pengarang
                        </label>

                        <input
                            v-model="form.pengarang"
                            type="text"
                            class="w-full rounded-md border border-gray-300 p-3"
                            required
                        />

                        <p
                            v-if="form.errors.pengarang"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.pengarang }}
                        </p>
                    </div>

                    <!-- Penerbit -->
                    <div>
                        <label class="mb-1 block font-medium text-gray-700">
                            Penerbit
                        </label>

                        <input
                            v-model="form.penerbit"
                            type="text"
                            class="w-full rounded-md border border-gray-300 p-3"
                        />

                        <p
                            v-if="form.errors.penerbit"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.penerbit }}
                        </p>
                    </div>

                    <!-- Tahun Terbit -->
                    <div>
                        <label class="mb-1 block font-medium text-gray-700">
                            Tahun Terbit
                        </label>

                        <input
                            v-model="form.tahun"
                            type="number"
                            min="1000"
                            max="9999"
                            class="w-full rounded-md border border-gray-300 p-3"
                        />

                        <p
                            v-if="form.errors.tahun"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.tahun }}
                        </p>
                    </div>

                    <!-- Stok -->
                    <div>
                        <label class="mb-1 block font-medium text-gray-700">
                            Stok
                        </label>

                        <input
                            v-model.number="form.stok"
                            type="number"
                            min="0"
                            class="w-full rounded-md border border-gray-300 p-3"
                            required
                        />

                        <p
                            v-if="form.errors.stok"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.stok }}
                        </p>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex flex-wrap gap-3 border-t pt-5">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="rounded-md bg-blue-600 px-6 py-3 font-semibold text-white hover:bg-blue-700 disabled:opacity-50"
                        >
                            {{
                                form.processing
                                    ? 'Menyimpan...'
                                    : 'Simpan Perubahan'
                            }}
                        </button>

                        <Link
                            href="/books"
                            class="rounded-md bg-gray-200 px-6 py-3 font-semibold text-gray-800 hover:bg-gray-300"
                        >
                            Kembali
                        </Link>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>