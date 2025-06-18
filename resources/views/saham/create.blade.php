@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Saham</h2>
    <form action="{{ route('saham.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="product_id">Product ID</label>
            <input type="text" class="form-control" name="product_id" id="product_id" required>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" name="quantity" id="quantity" required>
        </div>
        <div class="form-group">
            <label for="entry_date">Entry Date</label>
            <input type="datetime-local" class="form-control" name="entry_date" id="entry_date" required>
        </div>
        <div class="form-group">
            <label for="exit_date">Exit Date (Optional)</label>
            <input type="datetime-local" class="form-control" name="exit_date" id="exit_date">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
