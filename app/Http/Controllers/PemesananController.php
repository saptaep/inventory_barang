<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemesananProduk;
use App\Models\Produk;

class PemesananController extends Controller
{
    /**
     * Menampilkan daftar pemesanan.
     */
    public function index()
    {
        // Menampilkan daftar pemesanan beserta produk terkait
        $pemesanan = PemesananProduk::with('produk')->get();
        return view('pemesanan.index', compact('pemesanan'));
    }

    /**
     * Menampilkan form untuk menambahkan pemesanan produk.
     */
    public function create()
    {
        $produk = Produk::all(); // Ambil semua produk
        return view('pemesanan.create', compact('produk'));
    }

    /**
     * Menyimpan data pemesanan baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produk,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Mendapatkan data produk berdasarkan id_produk
        $produk = Produk::findOrFail($request->id_produk);

        // Mengecek apakah jumlah yang diminta tersedia
        if ($produk->jumlah < $request->jumlah) {
            return redirect()->route('pemesanan.create')->with('error', 'Jumlah produk yang tersedia tidak cukup.');
        }

        // Menghitung total harga
        $totalHarga = $produk->harga * $request->jumlah;

        // Membuat pemesanan
        PemesananProduk::create([
            'id_produk' => $request->id_produk,
            'jumlah' => $request->jumlah,
            'total_harga' => $totalHarga,
            'status' => 'pending',
        ]);

        // Mengurangi jumlah produk yang tersedia di tabel produk
        $produk->decrement('jumlah', $request->jumlah);

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil dibuat.');
    }

    /**
     * Menampilkan form untuk mengedit pemesanan.
     */
    public function edit($id)
    {
        // Mendapatkan pemesanan berdasarkan ID
        $pemesanan = PemesananProduk::findOrFail($id);
        $produk = Produk::all(); // Ambil semua produk untuk dropdown
        return view('pemesanan.edit', compact('pemesanan', 'produk'));
    }

    /**
     * Memperbarui data pemesanan.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_produk' => 'required|exists:produk,id',
            'jumlah' => 'required|integer|min:1',
            'status' => 'required|in:pending,processed,completed,canceled',
        ]);

        // Mendapatkan data pemesanan yang akan diperbarui
        $pemesanan = PemesananProduk::findOrFail($id);

        // Mengecek apakah jumlah produk yang diminta tersedia
        $produk = Produk::findOrFail($request->id_produk);
        if ($produk->jumlah + $pemesanan->jumlah < $request->jumlah) {
            return redirect()->route('pemesanan.edit', $id)->with('error', 'Jumlah produk yang tersedia tidak cukup.');
        }

        // Menghitung total harga baru
        $totalHarga = $produk->harga * $request->jumlah;

        // Memperbarui data pemesanan
        $pemesanan->update([
            'id_produk' => $request->id_produk,
            'jumlah' => $request->jumlah,
            'total_harga' => $totalHarga,
            'status' => $request->status,
        ]);

        // Mengupdate jumlah produk yang tersedia di tabel produk
        $produk->decrement('jumlah', $request->jumlah - $pemesanan->jumlah);

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil diperbarui.');
    }

    /**
     * Menghapus pemesanan.
     */
    public function destroy($id)
    {
        $pemesanan = PemesananProduk::findOrFail($id);
        $pemesanan->delete();

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil dihapus.');
    }
}
