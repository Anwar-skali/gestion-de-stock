@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Order Details</h1>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Order #{{ $order->id }}</h5>
            <p class="card-text"><strong>Client:</strong> {{ $order->client->name }}</p>
            <p class="card-text"><strong>Order Date:</strong> {{ $order->order_date ? $order->order_date->format('d/m/Y') : 'N/A' }}</p>
            <p class="card-text"><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
@endsection