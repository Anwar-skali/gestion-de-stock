@extends('layouts.client')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="text-primary fw-bold">Détails de la commande</h1>
            <p class="text-muted">Commande #{{ $order->id }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0 text-primary">Informations de la commande</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h6 class="text-muted mb-3">Statut de la commande</h6>
                                @if($order->status == 'pending')
                                    <span class="badge bg-warning">
                                        <i class="fas fa-clock mr-1"></i> En attente
                                    </span>
                                @elseif($order->status == 'completed')
                                    <span class="badge bg-success">
                                        <i class="fas fa-check mr-1"></i> Complétée
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        <i class="fas fa-times mr-1"></i> Annulée
                                    </span>
                                @endif
                            </div>
                            <div class="mb-4">
                                <h6 class="text-muted mb-3">Date de commande</h6>
                                <p class="mb-0">
                                    <i class="fas fa-calendar-alt text-muted mr-2"></i>
                                    {{ $order->order_date->format('d/m/Y') }}
                                </p>
                            </div>
                            <div>
                                <h6 class="text-muted mb-3">Montant total</h6>
                                <p class="mb-0">
                                    <i class="fas fa-euro-sign text-muted mr-2"></i>
                                    {{ number_format($order->total_amount, 2) }} €
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0 text-primary">Produits commandés</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Produit</th>
                                    <th>Quantité</th>
                                    <th>Prix unitaire</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->produits as $produit)
                                    <tr>
                                        <td>
                                            <i class="fas fa-box text-muted mr-2"></i>
                                            {{ $produit->name }}
                                        </td>
                                        <td>
                                            <i class="fas fa-hashtag text-muted mr-2"></i>
                                            {{ $produit->pivot->quantity }}
                                        </td>
                                        <td>
                                            <i class="fas fa-euro-sign text-muted mr-2"></i>
                                            {{ number_format($produit->pivot->price, 2) }} €
                                        </td>
                                        <td>
                                            <i class="fas fa-euro-sign text-muted mr-2"></i>
                                            {{ number_format($produit->pivot->quantity * $produit->pivot->price, 2) }} €
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-primary mb-3">Actions rapides</h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('client.orders.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Retour à la liste des commandes
                        </a>
                        <a href="{{ route('client.dashboard') }}" class="btn btn-primary">
                            <i class="fas fa-chart-line"></i> Retour au tableau de bord
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.gap-2 {
    gap: 0.5rem;
}
.table th {
    font-weight: 600;
}
.badge {
    padding: 0.5em 0.75em;
    font-weight: 500;
}
</style>
@endsection 