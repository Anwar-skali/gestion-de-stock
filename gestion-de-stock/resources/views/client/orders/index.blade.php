@extends('layouts.client')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="text-primary fw-bold">Mes Commandes</h1>
            <p class="text-muted">Consultez l'historique de vos commandes</p>
        </div>
    </div>

    <!-- Statistiques des commandes -->
    <div class="row mb-4 g-3">
        <div class="col-md-4">
            <div class="card text-white bg-primary h-100 shadow-sm hover-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Total des Commandes</h6>
                            <h2 class="mt-2 mb-0">{{ $orders->count() }}</h2>
                        </div>
                        <i class="fas fa-shopping-cart fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success h-100 shadow-sm hover-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Commandes Complétées</h6>
                            <h2 class="mt-2 mb-0">{{ $orders->where('status', 'completed')->count() }}</h2>
                        </div>
                        <i class="fas fa-check-circle fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning h-100 shadow-sm hover-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Commandes en Attente</h6>
                            <h2 class="mt-2 mb-0">{{ $orders->where('status', 'pending')->count() }}</h2>
                        </div>
                        <i class="fas fa-clock fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des commandes -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0 text-primary">Historique des commandes</h5>
                </div>
                <div class="card-body">
                    @if($orders->isEmpty())
                        <div class="text-center py-4">
                            <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Vous n'avez pas encore de commandes.</p>
                            <a href="{{ route('client.products') }}" class="btn btn-primary mt-2">
                                <i class="fas fa-box"></i> Voir les produits disponibles
                            </a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>
                                                <i class="fas fa-calendar-alt text-muted mr-2"></i>
                                                {{ $order->order_date->format('d/m/Y') }}
                                            </td>
                                            <td>
                                                <i class="fas fa-euro-sign text-muted mr-2"></i>
                                                {{ number_format($order->total_amount, 2) }} €
                                            </td>
                                            <td>
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
                                            </td>
                                            <td>
                                                <a href="{{ route('client.orders.show', $order) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i> Détails
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
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
                        <a href="{{ route('client.products') }}" class="btn btn-primary">
                            <i class="fas fa-box"></i> Voir les produits disponibles
                        </a>
                        <a href="{{ route('client.dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-chart-line"></i> Retour au tableau de bord
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hover-card {
    transition: transform 0.2s ease-in-out;
}
.hover-card:hover {
    transform: translateY(-5px);
}
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