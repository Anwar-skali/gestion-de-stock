<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Order;
use App\Models\Produit;
use App\Models\Facture;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Récupérer les totaux
        $totalClients = Client::count();
        $totalOrders = Order::count();
        $totalProduits = Produit::count();
        $totalFactures = Facture::count();

        // Commandes par mois
        $ordersData = [];
        $ordersLabels = [];
        for ($i = 1; $i <= 12; $i++) {
            $month = Carbon::create()->month($i)->format('F');
            $ordersLabels[] = $month;
            $ordersData[] = Order::whereMonth('created_at', $i)->count();
        }

        // Statistiques des produits pour le graphique en donut
        // Produits disponibles : quantité > 0
        $produitsDisponibles = Produit::where('quantity', '>', 0)->count();
        
        // Produits en rupture : quantité = 0
        $produitsEnRupture = Produit::where('quantity', '=', 0)->count();
        
        // Produits en commande : quantité = 0 avec une commande en cours
        $produitsEnCommande = Produit::where('quantity', '=', 0)
            ->whereHas('orders', function($query) {
                $query->where('status', 'pending');
            })
            ->count();

        $produitsLabels = ['Disponible', 'En rupture', 'En commande'];
        $produitsData = [$produitsDisponibles, $produitsEnRupture, $produitsEnCommande];

        // Statistiques globales pour le nouveau graphique en donut
        $globalLabels = ['Commandes', 'Produits', 'Factures'];
        $globalData = [$totalOrders, $totalProduits, $totalFactures];

        // Calcul de la valeur totale du stock
        $totalStockValue = Produit::sum(DB::raw('price * quantity'));

        // Top 5 des produits les plus commandés
        $topProducts = Produit::withCount('orders')
            ->orderBy('orders_count', 'desc')
            ->take(5)
            ->get();

        return response()->view('dashboard.index', compact(
            'totalClients',
            'totalOrders',
            'totalProduits',
            'totalFactures',
            'ordersLabels',
            'ordersData',
            'totalStockValue',
            'topProducts',
            'produitsLabels',
            'produitsData',
            'globalLabels',
            'globalData'
        ))
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
        ->header('Pragma', 'no-cache')
        ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
    }
}