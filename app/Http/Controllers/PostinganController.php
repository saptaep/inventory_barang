<?php

namespace App\Http\Controllers;

use App\Models\Postingan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostinganController extends Controller
{
    // Menampilkan daftar postingan
    public function index()
    {
        $postingan = Postingan::with('produk')->get(); // Ambil postingan beserta data produk
        $produk = Produk::all(); // Ambil semua produk

        return view('postingan.index', compact('postingan', 'produk'));
    }

    // Menampilkan form untuk membuat postingan baru
    public function create()
    {
        $produk = Produk::all(); // Ambil semua produk
        return view('postingan.create', compact('produk'));
    }

    // Menyimpan postingan ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'gambar' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'judul' => 'required|string|max:255',
            'id_produk' => 'nullable|exists:produk,id', // Validasi foreign key
        ]);

        // Debug input data untuk memastikan `id_produk` diterima
        // dd($request->all());

        // Simpan gambar
        $gambarPath = $request->file('gambar')->store('postingan', 'public');

        // Simpan data postingan ke database
        Postingan::create([
            'judul' => $request->judul,
            'gambar' => $gambarPath,
            'id_produk' => $request->id_produk ?? null, // Null jika tidak dipilih
        ]);
//    // Debug data request
//     dd($request->all());
        return redirect()->route('postingan.index')->with('success', 'Postingan berhasil ditambahkan.');

    }
public function edit($id)
{
    $postingan = Postingan::findOrFail($id); // Change $post to $postingan
    $produk = Produk::all(); // Mendapatkan semua produk
    return view('postingan.edit', compact('postingan', 'produk')); // Pass $postingan, not $post
}
public function update(Request $request, $id)
{
    $postingan = Postingan::findOrFail($id);

    $request->validate([
        'judul' => 'required|string|max:255',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'id_produk' => 'nullable|exists:produk,id',
    ]);

    $postingan->judul = $request->judul;
    $postingan->id_produk = $request->id_produk;

    if ($request->hasFile('gambar')) {
        // Hapus gambar lama
        if ($postingan->gambar) {
            Storage::disk('public')->delete($postingan->gambar);
        }

        // Simpan gambar baru
        $path = $request->file('gambar')->store('postingan', 'public');
        $postingan->gambar = $path;
    }

    $postingan->save();

    return redirect()->route('postingan.index')->with('success', 'Postingan berhasil diperbarui.');
}

    // Menghapus postingan
    public function destroy($id)
    {
        $postingan = Postingan::findOrFail($id);

        // Hapus gambar jika ada
        if (Storage::disk('public')->exists($postingan->gambar)) {
            Storage::disk('public')->delete($postingan->gambar);
        }

        // Hapus postingan
        $postingan->delete();

        return redirect()->route('postingan.index')->with('success', 'Postingan berhasil dihapus.');
    }
}
