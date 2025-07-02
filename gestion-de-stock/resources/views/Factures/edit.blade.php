@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Edit Facture</h1>
        <a href="{{ route('factures.index') }}" class="btn btn-secondary">Back to Factures</a>
    </div>

    <form action="{{ route('factures.update', $facture->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="client_id">Client</label>
            <select name="client_id" id="client_id" class="form-control" required>
                <option value="">Select a Client</option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}" {{ $facture->client_id == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="order_id">Order</label>
            <select name="order_id" id="order_id" class="form-control" required>
                <option value="">Select an Order</option>
                @foreach ($orders as $order)
                    <option value="{{ $order->id }}" {{ $facture->order_id == $order->id ? 'selected' : '' }}>Order #{{ $order->id }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="invoice_date">Invoice Date</label>
            <input type="date" name="invoice_date" id="invoice_date" class="form-control" value="{{ $facture->invoice_date }}" required>
        </div>

        <div class="form-group">
            <label for="total_amount">Total Amount</label>
            <input type="number" name="total_amount" id="total_amount" class="form-control" step="0.01" value="{{ $facture->total_amount }}" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection