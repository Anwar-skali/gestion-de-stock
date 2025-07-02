@extends('layouts.client')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="text-primary fw-bold">Nos Produits</h1>
            <p class="text-muted">Découvrez notre catalogue de produits</p>
        </div>
    </div>

    <!-- Statistiques des produits -->
    <div class="row mb-4 g-3">
        <div class="col-md-4">
            <div class="card text-white bg-primary h-100 shadow-sm hover-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Total des Produits</h6>
                            <h2 class="mt-2 mb-0">{{ $products->count() }}</h2>
                        </div>
                        <i class="fas fa-box fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success h-100 shadow-sm hover-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Produits Disponibles</h6>
                            <h2 class="mt-2 mb-0">{{ $products->where('quantity', '>', 0)->count() }}</h2>
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
                            <h6 class="card-title mb-0">Produits en Commande</h6>
                            <h2 class="mt-2 mb-0">{{ $products->where('quantity', 0)->count() }}</h2>
                        </div>
                        <i class="fas fa-clock fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des produits -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0 text-primary">Catalogue des produits</h5>
                </div>
                <div class="card-body">
                    @if($products->isEmpty())
                        <div class="text-center py-4">
                            <i class="fas fa-box fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Aucun produit disponible pour le moment.</p>
                        </div>
                    @else
                        <div class="row g-4">
                            @foreach($products as $product)
                                <div class="col-md-4">
                                    <div class="card h-100 shadow-sm hover-card">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary mb-3">
                                                <i class="fas fa-box text-muted mr-2"></i>
                                                {{ $product->name }}
                                            </h5>
                                            
                                            @if($product->quantity > 0)
                                                <p class="card-text text-muted mb-3">
                                                    <i class="fas fa-info-circle mr-2"></i>
                                                    {{ $product->description }}
                                                </p>
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <span class="text-primary fw-bold">
                                                        <i class="fas fa-euro-sign mr-1"></i>
                                                        {{ number_format($product->price, 2) }}
                                                    </span>
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check mr-1"></i>
                                                        En stock
                                                    </span>
                                                </div>
                                                <form action="{{ route('client.orders.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="produit_id" value="{{ $product->id }}">
                                                    <div class="input-group mb-3">
                                                        <input type="number" name="quantity" class="form-control" value="1" min="1" max="{{ $product->quantity }}">
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fas fa-cart-plus"></i> Commander
                                                        </button>
                                                    </div>
                                                </form>
                                            @else
                                                <div class="text-center py-3">
                                                    @if($product->orders()->where('status', 'pending')->exists())
                                                        <span class="badge bg-warning">
                                                            <i class="fas fa-clock mr-1"></i>
                                                            En commande
                                                        </span>
                                                    @else
                                                        <span class="badge bg-danger">
                                                            <i class="fas fa-times mr-1"></i>
                                                            En rupture de stock
                                                        </span>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
                        <a href="{{ route('client.orders.index') }}" class="btn btn-primary">
                            <i class="fas fa-shopping-cart"></i> Voir mes commandes
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
.badge {
    padding: 0.5em 0.75em;
    font-weight: 500;
}
.card {
    border: none;
    border-radius: 10px;
}
.input-group {
    border-radius: 5px;
    overflow: hidden;
}
.input-group .form-control {
    border-right: none;
}
.input-group .btn {
    border-left: none;
}
</style>
@endsection 