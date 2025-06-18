@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center mb-8">Edit Pemesanan</h1>

        <a href="{{ route('pemesanan.index') }}" class="text-black-500 hover:text-blue-600 mb-4 inline-block">
            &larr; Kembali
        </a>

        <form action="{{ route('pemesanan.update', $pemesanan->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Produk -->
            <div>
                <label for="id_produk" class="block text-sm font-medium text-gray-700">Produk</label>
                <select name="id_produk" id="id_produk" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                    @foreach ($produk as $prod)
                        <option value="{{ $prod->id }}" {{ $prod->id == $pemesanan->id_produk ? 'selected' : '' }}>
                            {{ $prod->nama }} - Rp {{ number_format($prod->harga, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
                @error('id_produk')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Jumlah -->
            <div>
                <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', $pemesanan->jumlah) }}" min="1" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                @error('jumlah')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                    <option value="pending" {{ $pemesanan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processed" {{ $pemesanan->status == 'processed' ? 'selected' : '' }}>Processed</option>
                    <option value="completed" {{ $pemesanan->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="canceled" {{ $pemesanan->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                </select>
                @error('status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol Update -->
            <div class="text-center">
                <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-md">Update Pemesanan</button>
            </div>
        </form>
    </div>
@endsection
