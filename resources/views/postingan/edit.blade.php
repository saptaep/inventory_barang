@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-10">
        <h1 class="text-3xl font-bold text-center mb-8">Edit Postingan</h1>

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

        <!-- Form untuk mengedit postingan -->
        <form action="{{ route('postingan.update', $postingan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Menggunakan PUT untuk update -->
            
            <div class="mb-4">
                <label for="judul" class="block font-semibold">Judul Postingan:</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $postingan->judul) }}" class="border border-gray-300 rounded-md w-full p-2" required>
            </div>
            <div class="mb-4">
                <label for="gambar" class="block font-semibold">Gambar:</label>
                <input type="file" name="gambar" id="gambar" class="border border-gray-300 rounded-md w-full p-2">
                @if ($postingan->gambar)
                    <img src="{{ Storage::url($postingan->gambar) }}" alt="Current Image" class="mt-2 w-32 h-32 object-cover rounded-md">
                @endif
            </div>
            <div class="mb-4">
                <label for="id_produk" class="block font-semibold">Pilih Produk (Opsional):</label>
                <select name="id_produk" id="id_produk" class="border border-gray-300 rounded-md w-full p-2">
                    <option value="">-- Tidak ada produk --</option>
                    @foreach ($produk as $item)
                        <option value="{{ $item->id }}" @if($postingan->id_produk == $item->id) selected @endif>{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                Update Postingan
            </button>
        </form>
    </div>
@endsection
