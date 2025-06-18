@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-10">
    <a href="{{ route('postingan.index') }}" class="text-black-500 hover:text-blue-600 mb-4 inline-block">
            &larr; Kembali
        </a>
        <h1 class="text-3xl font-bold text-center mb-8">Tambah Pemesanan</h1>

        <!-- Menampilkan pesan error jika stok produk tidak cukup -->
        @if(session('error'))
            <div class="bg-red-500 text-white p-3 rounded-md mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form untuk membuat pemesanan -->
        <form action="{{ route('pemesanan.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="id_produk" class="block font-semibold">Pilih Produk:</label>
                <select name="id_produk" id="id_produk" class="border border-gray-300 rounded-md w-full p-2">
                    <option value="">-- Pilih Produk --</option>
                    @foreach ($produk as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->nama }} - Rp. {{ number_format($item->harga, 2) }} (Tersedia: {{ $item->jumlah }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="jumlah" class="block font-semibold">Jumlah:</label>
                <input type="number" name="jumlah" id="jumlah" class="border border-gray-300 rounded-md w-full p-2" required min="1">
            </div>

            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-md">Buat Pemesanan</button>
        </form>
    </div>
@endsection
