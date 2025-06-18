@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Statistik Grafik --}}
    <div class="mt-16 mb-5">
        <canvas id="laporanChart" height="100"></canvas>
    </div>

    {{-- Tabel Laporan --}}
    <div class="flex justify-center">
    <table class="table-auto w-1/2 text-sm bg-white shadow-md rounded-lg border border-gray-300 ">
    <thead class="bg-green-500 text-white">
            <tr>
                        <!-- <th class="border border-gray-300 py-2 px-2 text-left">Id Produk</th> -->
                        <th class="border border-gray-300 py-2 px-2 text-center">Nama Produk</th>
                        <th class="border border-gray-300 py-2 px-2 text-center">Jumlah Tersedia</th>
                        <th class="border border-gray-300 py-2 px-2 text-center">Total Dipesan</th>
                <!-- <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Jumlah Tersedia</th>
                <th>Total Dipesan</th> -->
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $produk)
            <tr class="bg-white hover:bg-gray-100">
                            <!-- <td class="border border-gray-300 py-1 px-2">{{ $produk->id }}</td> -->
                            <td class="border border-gray-300 py-1 px-2 text-center">{{ $produk->nama }}</td>
                            <td class="border border-gray-300 py-1 px-2 text-center">{{ $produk->stok_tersedia }}</td>
                            <td class="border border-gray-300 py-1 px-2 text-center">{{ $produk->total_dipesan }}</td>
                        </tr>
            <!-- <tr>
                <td>{{ $produk->id }}</td>
                <td>{{ $produk->nama }}</td>
                <td>{{ $produk->stok_tersedia }}</td>
                <td>{{ $produk->total_dipesan }}</td>
            </tr> -->
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('laporanChart').getContext('2d');

    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($laporan->pluck('nama')) !!},
            datasets: [
                {
                    label: 'Jumlah Tersedia',
                    data: {!! json_encode($laporan->pluck('stok_tersedia')) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.6)'
                },
                {
                    label: 'Total Dipesan',
                    data: {!! json_encode($laporan->pluck('total_dipesan')) !!},
                    backgroundColor: 'rgba(255, 99, 132, 0.6)'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Statistik Laporan Produk'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah'
                    }
                }
            }
        }
    });
</script>
@endsection
