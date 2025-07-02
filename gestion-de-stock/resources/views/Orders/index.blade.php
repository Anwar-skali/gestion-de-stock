@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Commandes</h1>
        <a href="{{ route('orders.create') }}" class="btn btn-primary">Add New Order</a>
    </div>

    @if ($orders->isEmpty())
        <div class="alert alert-warning">Aucune commande trouvée.</div>
    @else
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->client->name }}</td>
                                    <td>{{ $order->order_date ? $order->order_date->format('d/m/Y') : 'N/A' }}</td>
                                    <td>{{ number_format($order->total_amount, 2) }} €</td>
                                    <td>
                                        @if($order->status == 'pending')
                                            <span class="badge bg-warning">En attente</span>
                                        @elseif($order->status == 'completed')
                                            <span class="badge bg-success">Complétée</span>
                                        @else
                                            <span class="badge bg-danger">Annulée</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">Détails</a>
                                            @if($order->status == 'pending')
                                                <form action="{{ route('orders.complete', $order->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">Compléter</button>
                                                </form>
                                                <form action="{{ route('orders.cancel', $order->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">Annuler</button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection
