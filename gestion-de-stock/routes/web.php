<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\ClientAuthController;
use App\Http\Controllers\ClientOrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Routes publiques (sans authentification)
Route::middleware('guest')->group(function () {
    // Routes admin
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Routes client
    Route::get('/client/register', [ClientAuthController::class, 'showRegisterForm'])->name('client.register');
    Route::post('/client/register', [ClientAuthController::class, 'register']);
    Route::get('/client/login', [ClientAuthController::class, 'showLoginForm'])->name('client.login');
    Route::post('/client/login', [ClientAuthController::class, 'login']);
});

// Routes protégées (avec authentification admin)
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Ressources
    Route::resource('clients', ClientController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('produits', ProduitController::class);
    Route::resource('factures', FactureController::class);
    Route::get('factures/{facture}/download-pdf', [FactureController::class, 'downloadPdf'])->name('factures.download-pdf');

    // Routes pour la gestion des commandes
    Route::post('/produits/{produit}/order', [OrderController::class, 'orderProduct'])->name('produits.order');
    Route::post('/orders/{order}/complete', [OrderController::class, 'completeOrder'])->name('orders.complete');
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancelOrder'])->name('orders.cancel');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Routes protégées (avec authentification client)
Route::middleware('auth:client')->prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [ClientOrderController::class, 'dashboard'])->name('dashboard');
    Route::get('/products', [ClientOrderController::class, 'products'])->name('products');
    Route::post('/orders', [ClientOrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [ClientOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [ClientOrderController::class, 'show'])->name('orders.show');
    Route::post('/logout', [ClientAuthController::class, 'logout'])->name('logout');
});