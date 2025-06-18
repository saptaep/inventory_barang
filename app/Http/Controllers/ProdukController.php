<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // Menampilkan semua produk
    public function index()
    {
        $produk = Produk::all();
        return view('produk.index', compact('produk')); // Mengirim data produk ke view
    }

public function store(Request $request)
{
    // Debug untuk melihat data yang dikirim
    \Log::info('Data Produk:', $request->all());

    // Validasi
    $validatedData = $request->validate([
        'nama' => 'required|string|max:255',
        'harga' => 'required|numeric',
        'deskripsi' => 'nullable|string',
        'kategori' => 'nullable|string|max:100',
        'jumlah' => 'required|integer|min:0', // Tambahkan validasi jumlah
    ]);

    // Simpan produk
    Produk::create($validatedData);

    return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
}


    // Menampilkan produk berdasarkan ID
    public function show($id)
    {
        $produk = Produk::find($id);
        return view('produk.show', compact('produk')); // Mengirim produk ke view show
    }

    // Mengupdate produk berdasarkan ID
    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        if (!$produk) {
            return redirect()->route('produk.index')->with('error', 'Produk tidak ditemukan');
        }

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'kategori' => 'nullable|string|max:100',
            'jumlah' => 'required|integer|min:0', // Tambahkan validasi jumlah
        ]);

        $produk->update($validatedData); // Mengupdate produk di database
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui'); // Redirect ke halaman daftar produk
    }

    // Menghapus produk berdasarkan ID
    public function destroy($id)
    {
        $produk = Produk::find($id);
        if ($produk) {
            $produk->delete(); // Menghapus produk dari database
            return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus');
        }
        return redirect()->route('produk.index')->with('error', 'Produk tidak ditemukan');
    }
    
}
