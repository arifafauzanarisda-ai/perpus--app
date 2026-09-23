<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()

    {
        $judul = 'sistem informasi pinjam buku perpustakaan mini';
        return view('home',['judul' => $judul]);
    }
}
