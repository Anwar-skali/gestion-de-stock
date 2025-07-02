@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>{{ isset($order) ? 'Edit Order' : 'Create Order' }}</h1>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
    </div>

    <form action="{{ isset($order) ? route('orders.update', $order->id) : route('orders.store') }}" method="POST">
        @csrf
        @if (isset($order))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="client_id">Client</label>
            <select name="client_id" id="client_id" class="form-control" required>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}" {{ (isset($order) && $order->client_id == $client->id) ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="order_date">Order Date</label>
            <input type="date" name="order_date" id="order_date" class="form-control" value="{{ old('order_date', $order->order_date ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="total_amount">Total Amount</label>
            <input type="number" name="total_amount" id="total_amount" class="form-control" step="0.01" value="{{ old('total_amount', $order->total_amount ?? '') }}" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                {{ isset($order) ? 'Update' : 'Save' }}
            </button>
        </div>
    </form>
@endsection
