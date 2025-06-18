@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-10">
        <!-- Tombol untuk menampilkan form tambah postingan -->
        <a href="{{ route('postingan.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700 mb-6">
            Tambahkan Postingan
        </a>

        <!-- Daftar Postingan -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
            @forelse ($postingan as $post)
                <div class="bg-white shadow-md rounded-lg p-4">
                    <h2 class="text-xl font-bold mb-2">{{ $post->judul }}</h2>
                    <img src="{{ Storage::url($post->gambar) }}" alt="{{ $post->judul }}" class="w-full h-40 object-cover rounded-md mb-2">

                    <!-- Menampilkan produk terkait -->
                    @if ($post->produk)
                        <p class="text-gray-600">Produk Terkait: {{ $post->produk->nama }}</p>
                    @else
                        <p class="text-gray-500">Produk Terkait: Tidak ada</p>
                    @endif

                    <!-- Tombol Edit dengan ikon -->
                    <a href="{{ route('postingan.edit', $post->id) }}" class="text-yellow-500 hover:text-yellow-600 text-2xl inline-block mt-2">
                        <i class="fas fa-edit"></i> <!-- Ikon Edit -->
                    </a>

                    <!-- Tombol Delete dengan ikon -->
                    <form action="{{ route('postingan.destroy', $post->id) }}" method="POST" class="mt-4 inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-600 text-2xl">
                            <i class="fas fa-trash"></i> <!-- Ikon Trash -->
                        </button>
                    </form>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500">Belum ada postingan yang diupload.</p>
            @endforelse
        </div>
    </div>
@endsection
