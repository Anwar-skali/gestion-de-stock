@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Factures</h1>
        <a href="{{ route('factures.create') }}" class="btn btn-primary">Add New Facture</a>
    </div>

    @if ($factures->isEmpty())
        <div class="alert alert-warning">No factures found. Please add a new facture.</div>
    @else
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Order</th>
                    <th>Invoice Date</th>
                    <th>Total Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($factures as $facture)
                    <tr>
                        <td>{{ $facture->client->name }}</td>
                        <td>Order #{{ $facture->order->id }}</td>
                        <td>{{ $facture->invoice_date }}</td>
                        <td>${{ number_format($facture->total_amount, 2) }}</td>
                        <td>
                            <a href="{{ route('factures.download-pdf', $facture->id) }}" class="btn btn-info btn-sm">Download PDF</a>
                            <a href="{{ route('factures.edit', $facture->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('factures.destroy', $facture->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection