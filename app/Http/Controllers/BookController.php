<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Mengambil data buku berdasarkan kata kunci pencarian
        $books = Book::when($request->search, function ($query, $search) {
            // Mencari berdasarkan judul atau nama pengarang
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('pengarang', 'like', "%{$search}%");
            });
        })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Mengirim data buku dan kata kunci pencarian ke halaman Vue
        return inertia('Books/Index', [
            'books' => $books,
            'search' => $request->search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Nama halaman cukup 'Books/Create' tanpa .vue
        return inertia('Books/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi data yang dikirim dari form
        $validated = $request->validate([
            'kode_buku' => 'required|string|max:255|unique:books,kode_buku',
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'tahun' => 'required|digits:4',
            'stok' => 'required|integer|min:0',
        ]);

        // 2. Simpan sebagai baris baru di tabel books (nama kolom sudah sesuai dengan validasi)
        Book::create($validated);

        // 3. Kembali ke daftar buku dengan pesan sukses
        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        // Mengambil data buku yang akan diedit melalui Route Model Binding
        // Mengirim data buku ke halaman Vue Books/Edit agar formulir menampilkan nilai lama
        return inertia('Books/Edit', [
            'book' => $book,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        // Aturan sama dengan store(), dengan satu perbedaan: kode_buku milik buku ini sendiri dikecualikan dari unique
        $validated = $request->validate([
            'kode_buku' => 'required|string|max:255|unique:books,kode_buku,' . $book->id,
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'tahun' => 'required|digits:4',
            'stok' => 'required|integer|min:0',
        ]);

        // Mengganti data lama pada $book dengan data baru yang sudah divalidasi
        $book->update($validated);

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        // Menghapus data buku dari tabel books
        $book->delete();

        // Kembali ke halaman daftar buku dengan pesan bahwa buku berhasil dihapus
        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil dihapus');
    }
}