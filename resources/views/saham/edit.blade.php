@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Saham</h2>
    <form action="{{ route('saham.update', $saham->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="product_id">Product ID</label>
            <input type="text" class="form-control" name="product_id" value="{{ $saham->product_id }}" required>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" name="quantity" value="{{ $saham->quantity }}" required>
        </div>
        <div class="form-group">
            <label for="entry_date">Entry Date</label>
            <input type="datetime-local" class="form-control" name="entry_date" value="{{ $saham->entry_date }}" required>
        </div>
        <div class="form-group">
            <label for="exit_date">Exit Date (Optional)</label>
            <input type="datetime-local" class="form-control" name="exit_date" value="{{ $saham->exit_date }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
