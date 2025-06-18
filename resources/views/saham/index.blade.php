@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Saham</h2>
    <a href="{{ route('saham.create') }}" class="btn btn-primary">Tambah Saham</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product ID</th>
                <th>Quantity</th>
                <th>Entry Date</th>
                <th>Exit Date</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sahams as $saham)
                <tr>
                    <td>{{ $saham->id }}</td>
                    <td>{{ $saham->product_id }}</td>
                    <td>{{ $saham->quantity }}</td>
                    <td>{{ $saham->entry_date }}</td>
                    <td>{{ $saham->exit_date }}</td>
                    <td>
                        <a href="{{ route('saham.edit', $saham->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('saham.destroy', $saham->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
