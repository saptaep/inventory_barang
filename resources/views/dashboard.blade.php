@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-10">
        <h1 class="text-3xl font-semibold mb-6">Selamat datang di UD Dua Putri Tani</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Info Produk -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold">Produk</h2>
                <p class="text-gray-500">Kelola semua produk Anda.</p>
                <a href="{{ route('produk.index') }}" class="mt-4 text-purple-600 hover:underline">Lihat Produk</a>
            </div>

            <!-- Info Postingan -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold">Postingan</h2>
                <p class="text-gray-500">Kelola semua postingan Anda.</p>
                <a href="{{ route('postingan.index') }}" class="mt-4 text-purple-600 hover:underline">Lihat Postingan</a>
            </div>
            <!-- Info Laporan -->
            <div class="w-96 bg-white rounded-lg shadow-lg p-6 ">
                <h2 class="text-xl font-semibold">Laporan</h2>
                <p class="text-gray-500">Lihat semua kegiatan produk Anda.</p>
                <a href="{{ route('laporan.produk') }}" class="mt-4 text-purple-600 hover:underline">Lihat Laporan Produk</a>
            </div>
        </div>
    </div>
@endsection