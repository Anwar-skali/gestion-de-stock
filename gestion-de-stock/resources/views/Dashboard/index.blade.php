@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1 class="mb-4 text-primary fw-bold">Tableau de Bord</h1>

        <!-- Affichage des totaux -->
        <div class="row mb-4 g-3">
            <div class="col-md-3">
                <div class="card text-white bg-primary h-100 shadow-sm hover-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title mb-0">Clients</h6>
                                <h2 class="mt-2 mb-0">{{ $totalClients }}</h2>
                            </div>
                            <i class="fas fa-users fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success h-100 shadow-sm hover-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title mb-0">Orders</h6>
                                <h2 class="mt-2 mb-0">{{ $totalOrders }}</h2>
                            </div>
                            <i class="fas fa-shopping-cart fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning h-100 shadow-sm hover-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title mb-0">Produits</h6>
                                <h2 class="mt-2 mb-0">{{ $totalProduits }}</h2>
                            </div>
                            <i class="fas fa-box fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger h-100 shadow-sm hover-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title mb-0">Factures</h6>
                                <h2 class="mt-2 mb-0">{{ $totalFactures }}</h2>
                            </div>
                            <i class="fas fa-file-invoice fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4 g-3">
            <!-- Graphique des commandes par mois -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-primary mb-4">Commandes par mois</h5>
                        <div style="height: 300px;">
                            <canvas id="ordersChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistiques globales -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-primary mb-4">Statistiques globales</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div style="height: 250px;">
                                    <canvas id="globalChart"></canvas>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mt-3">
                                    <h6 class="text-muted mb-3">Légende</h6>
                                    <div class="d-flex flex-column gap-2">
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-success me-2">&nbsp;</span>
                                            <span>Commandes ({{ $globalData[0] }})</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-warning me-2">&nbsp;</span>
                                            <span>Produits ({{ $globalData[1] }})</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-danger me-2">&nbsp;</span>
                                            <span>Factures ({{ $globalData[2] }})</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4 g-3">
            <!-- État du stock -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-primary mb-4">État du stock</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div style="height: 250px;">
                                    <canvas id="produitsChart"></canvas>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mt-3">
                                    <h6 class="text-muted mb-3">Légende</h6>
                                    <div class="d-flex flex-column gap-2">
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-success me-2">&nbsp;</span>
                                            <span>Disponible ({{ $produitsData[0] }})</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-danger me-2">&nbsp;</span>
                                            <span>En rupture ({{ $produitsData[1] }})</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-warning me-2">&nbsp;</span>
                                            <span>En commande ({{ $produitsData[2] }})</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top 5 des produits -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-primary mb-4">Top 5 des produits</h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Prix</th>
                                        <th>Stock</th>
                                        <th>Commandes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($topProducts as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>${{ number_format($product->price, 2) }}</td>
                                        <td>
                                            <span class="badge {{ $product->quantity > 0 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $product->quantity }}
                                            </span>
                                        </td>
                                        <td>{{ $product->orders_count }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inclure Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Inclure Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .hover-card {
            transition: transform 0.2s ease-in-out;
        }
        .hover-card:hover {
            transform: translateY(-5px);
        }
        .card {
            border: none;
            border-radius: 10px;
        }
        .card-body {
            padding: 1.5rem;
        }
        .opacity-50 {
            opacity: 0.5;
        }
        .badge {
            width: 20px;
            height: 20px;
            padding: 0;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Configuration commune pour les graphiques
            Chart.defaults.font.family = "'Poppins', sans-serif";
            Chart.defaults.color = '#6c757d';

            // Graphique des commandes par mois
            var ordersCtx = document.getElementById('ordersChart').getContext('2d');
            var ordersChart = new Chart(ordersCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($ordersLabels) !!},
                    datasets: [{
                        label: 'Orders',
                        data: {!! json_encode($ordersData) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.1)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            // Graphique en donut pour les statistiques globales
            var globalCtx = document.getElementById('globalChart').getContext('2d');
            var globalChart = new Chart(globalCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($globalLabels) !!},
                    datasets: [{
                        data: {!! json_encode($globalData) !!},
                        backgroundColor: [
                            'rgba(40, 167, 69, 0.8)',
                            'rgba(255, 193, 7, 0.8)',
                            'rgba(220, 53, 69, 0.8)'
                        ],
                        borderColor: [
                            'rgba(40, 167, 69, 1)',
                            'rgba(255, 193, 7, 1)',
                            'rgba(220, 53, 69, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return `${value} éléments (${percentage}%)`;
                                }
                            }
                        }
                    },
                    cutout: '70%'
                }
            });

            // Graphique en donut pour les statistiques des produits
            var produitsCtx = document.getElementById('produitsChart').getContext('2d');
            var produitsChart = new Chart(produitsCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($produitsLabels) !!},
                    datasets: [{
                        data: {!! json_encode($produitsData) !!},
                        backgroundColor: [
                            'rgba(40, 167, 69, 0.8)',
                            'rgba(220, 53, 69, 0.8)',
                            'rgba(255, 193, 7, 0.8)'
                        ],
                        borderColor: [
                            'rgba(40, 167, 69, 1)',
                            'rgba(220, 53, 69, 1)',
                            'rgba(255, 193, 7, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return `${value} produits (${percentage}%)`;
                                }
                            }
                        }
                    },
                    cutout: '70%'
                }
            });
        });
    </script>
@endsection