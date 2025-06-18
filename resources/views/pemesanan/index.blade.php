@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center mb-8">Daftar Pemesanan</h1>

        <a href="{{ route('pemesanan.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded-md mb-4 inline-block">
            Tambah Pemesanan
        </a>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-green-500 text-white">
                    <tr>
                        <th class="border border-gray-300 py-2 px-3 text-left">Produk</th>
                        <th class="border border-gray-300 py-2 px-3 text-center">Jumlah</th>
                        <th class="border border-gray-300 py-2 px-3 text-center">Total Harga</th>
                        <th class="border border-gray-300 py-2 px-3 text-center">Status</th>
                        <th class="border border-gray-300 py-2 px-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemesanan as $order)
                        <tr class="bg-white hover:bg-gray-100">
                            <td class="border border-gray-300 py-2 px-3">{{ $order->produk->nama }}</td>
                            <td class="border border-gray-300 py-2 px-3 text-center">{{ $order->jumlah }}</td>
                            <td class="border border-gray-300 py-2 px-3 text-right">
                                {{ 'Rp ' . number_format($order->total_harga, 0, ',', '.') }}
                            </td>
                            <td class="border border-gray-300 py-2 px-3 text-center">{{ ucfirst($order->status) }}</td>
                            <td class="border border-gray-300 py-2 px-3 text-center">
    <a href="{{ route('pemesanan.edit', $order->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md">Edit</a>
    <form action="{{ route('pemesanan.destroy', $order->id) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md">Hapus</button>
    </form>
</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
