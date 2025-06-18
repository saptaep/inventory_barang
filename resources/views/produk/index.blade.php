@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center mb-8">Tabel Produk UD Dua Putri Tani</h1>

        <!-- Tombol Tambah Produk -->
        <div class="flex justify-end mb-4">
            <button id="btnTambah" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700" 
                    onclick="openModal('tambah')">Tambah Produk</button>
        </div>

        <!-- Tabel Produk -->
        <div class="overflow-x-auto">
            <table class="table-auto w-full bg-white shadow-md rounded-lg border border-gray-300 ">
                <thead class="bg-green-500 text-white">
                    <tr>
                        <th class="px-4 py-2 border border-gray-300">No</th>
                        <th class="px-4 py-2 border border-gray-300">Nama</th>
                        <th class="px-4 py-2 border border-gray-300">Harga</th>
                        <th class="px-4 py-2 border border-gray-300">Deskripsi</th>
                        <th class="px-4 py-2 border border-gray-300">Kategori</th>
                        <th class="px-4 py-2 border border-gray-300">Jumlah</th>
                        <th class="px-4 py-2 border border-gray-300">Dibuat</th>
                        <th class="px-4 py-2 border border-gray-300">Diperbarui</th>
                        <th class="px-4 py-2 border border-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody id="produkTableBody">
                   @foreach($produk as $index => $item)
    <tr class="border-solid">
        <td class="px-4 py-2 border border-gray-300text-center">{{ $index + 1 }}</td>
        <td class="px-4 py-2 border border-gray-300">{{ $item->nama }}</td>
        <td class="px-4 py-2 border border-gray-300">{{ 'Rp '. number_format($item->harga, 0, ',', '.') }}</td>
        <td class="px-4 py-2 border border-gray-300">{{ $item->deskripsi ?? '-' }}</td>
        <td class="px-4 py-2 border border-gray-300">{{ $item->kategori ?? '-' }}</td>
        <td class="px-4 py-2 border border-gray-300 text-center">{{ $item->jumlah }}</td>
        <td class="px-4 py-2 border border-gray-300 text-center">{{ $item->created_at->format('d-m-Y H:i') }}</td>
                <td class="px-4 py-2 border border-gray-300 text-center">
                    @if($item->updated_at != $item->created_at)
                        {{ $item->updated_at->format('d-m-Y H:i') }}
                    @else
                        -
                    @endif
                </td>

        <td class="px-4 py-2 flex justify-center gap-2">
            <button class="bg-yellow-500 text-white px-3 py-1 rounded" 
                    onclick="openModal('edit', {{ json_encode($item) }})">Edit</button>
            <form action="{{ route('produk.destroy', $item->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded" 
                        onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
            </form>
        </td>
    </tr>
@endforeach
                </tbody>
            </table>
        </div>
    </div>

   <!-- Modal Produk -->
<div id="modalProduk" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full mx-auto mt-8">
        <h2 id="modalTitle" class="text-xl font-bold mb-4 text-center">Tambah Produk</h2>
        <form id="formProduk" action="{{ route('produk.store') }}" method="POST">
            @csrf
            <div class="mb-4 flex items-center">
                <!-- Label and Input Flex Layout -->
                <label for="nama" class="text-gray-700 mb-0 w-1/4 text-left">Nama Produk</label>
                <input type="text" id="nama" name="nama" class="w-3/4 p-2 border rounded" required>
            </div>
            <div class="mb-4 flex items-center">
                <!-- Label and Input Flex Layout -->
                <label for="harga" class="text-gray-700 mb-0 w-1/4 text-left">Harga</label>
                <input type="text" id="harga" name="harga" class="w-3/4 p-2 border rounded" required oninput="formatRupiah(this)">
            </div>
            <div class="mb-4 flex items-center">
                <!-- Label and Input Flex Layout -->
                <label for="deskripsi" class="text-gray-700 mb-0 w-1/4 text-left">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" class="w-3/4 p-2 border rounded"></textarea>
            </div>
            <div class="mb-4 flex items-center">
                <!-- Label and Input Flex Layout -->
                <label for="kategori" class="text-gray-700 mb-0 w-1/4 text-left">Kategori</label>
                <select id="kategori" name="kategori" class="w-3/4 p-2 border rounded" required>
                    <option value="" disabled selected>Pilih Kategori</option>
                    <option value="Pupuk">Pupuk</option>
                    <option value="Benih">Benih</option>
                    <option value="Pestisida">Pestisida</option>
                    <option value="Alat">Alat</option>
                </select>
            </div>
 <div class="mb-4 flex items-center">
        <label for="jumlah" class="text-gray-700 mb-0 w-1/4 text-left">Jumlah</label>
        <input type="number" id="jumlah" name="jumlah" class="w-3/4 p-2 border rounded" required>
    </div>
            <div class="flex justify-end">
                <button type="button" id="btnCloseModal" class="bg-gray-400 text-white px-4 py-2 rounded mr-2" onclick="hideModal()">Batal</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(mode, produk = null) {
        const modalTitle = document.getElementById('modalTitle');
        const form = document.getElementById('formProduk');
        
        if (mode === 'tambah') {
            modalTitle.textContent = 'Tambah Produk';
            form.action = "{{ route('produk.store') }}";
            form.method = 'POST';
            form.reset();
            const methodField = document.getElementById('methodField');
            if (methodField) methodField.remove();
        } else if (mode === 'edit') {
            modalTitle.textContent = 'Edit Produk';
            form.action = `/produk/${produk.id}`;
            form.method = 'POST';
            if (!document.getElementById('methodField')) {
                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'PUT';
                methodField.id = 'methodField';
                form.appendChild(methodField);
            }
            document.getElementById('nama').value = produk.nama;
            document.getElementById('harga').value = produk.harga;
            document.getElementById('deskripsi').value = produk.deskripsi || '';
            document.getElementById('kategori').value = produk.kategori || '';
            document.getElementById('jumlah').value = produk.jumlah || 0; // Tambahkan untuk jumlah
        }
        document.getElementById('modalProduk').classList.remove('hidden');
    }

    function hideModal() {
        document.getElementById('modalProduk').classList.add('hidden');
    }

    function formatRupiah(input) {
        let angka = input.value.replace(/[^,\d]/g, '');
        if (!angka) {
            input.value = '';
            return;
        }
        let rupiah = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(angka);
        input.value = rupiah;
    }

    document.getElementById('formProduk').addEventListener('submit', function (e) {
        let hargaInput = document.getElementById('harga');
        let hargaValue = hargaInput.value.replace(/[^0-9]/g, '');
        hargaInput.value = hargaValue;

        if (!hargaInput.value || isNaN(hargaInput.value) || hargaInput.value <= 0) {
            e.preventDefault();
            const errorMessage = document.getElementById('errorHarga');
            errorMessage.textContent = 'Harga tidak valid. Silakan masukkan angka yang valid.';
            errorMessage.classList.remove('hidden');
        }
    });
</script>
@endsection
