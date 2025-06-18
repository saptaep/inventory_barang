@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-10">
        <!-- Tombol Kembali ke Halaman Index -->
        <a href="{{ route('postingan.index') }}" class="text-black-500 hover:text-blue-600 mb-4 inline-block">
            &larr; Kembali
        </a>
        <h1 class="text-3xl font-bold text-center mb-8">Tambah Postingan</h1>

        <!-- Menampilkan pesan error jika ada -->
        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-red-600">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form untuk menambah postingan -->
        <form action="{{ route('postingan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="judul" class="block font-semibold">Judul Postingan:</label>
                <input type="text" name="judul" id="judul" class="border border-gray-300 rounded-md w-full p-2" required>
            </div>
            <div class="mb-4">
                <label for="gambar" class="block font-semibold">Gambar:</label>
                <input type="file" name="gambar" id="gambar" class="border border-gray-300 rounded-md w-full p-2" required>
            </div>
            <div class="mb-4">
                <label for="id_produk" class="block font-semibold">Pilih Produk (Opsional):</label>
                <select name="id_produk" id="id_produk" class="border border-gray-300 rounded-md w-full p-2">
                    <option value="">-- Tidak ada produk --</option>
                    @foreach ($produk as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700">
                Tambah Postingan
            </button>
        </form>
    </div>
@endsection
