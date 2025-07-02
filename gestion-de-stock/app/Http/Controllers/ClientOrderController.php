<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientOrderController extends Controller
{
    public function dashboard()
    {
        $client = Auth::guard('client')->user();
        $orders = $client->orders()->with('produits')->latest()->take(5)->get();
        return view('client.dashboard', compact('orders'));
    }

    public function products()
    {
        $products = Produit::where('quantity', '>', 0)->get();
        return view('client.products', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $produit = Produit::findOrFail($request->produit_id);

        if ($produit->quantity < $request->quantity) {
            return back()->with('error', 'La quantité demandée n\'est pas disponible.');
        }

        try {
            DB::beginTransaction();

            $order = Order::create([
                'client_id' => Auth::guard('client')->id(),
                'order_date' => now(),
                'total_amount' => $produit->price * $request->quantity,
                'status' => 'pending'
            ]);

            $order->produits()->attach($produit->id, [
                'quantity' => $request->quantity,
                'price' => $produit->price
            ]);

            $produit->update([
                'quantity' => $produit->quantity - $request->quantity
            ]);

            DB::commit();

            return redirect()->route('client.orders.index')
                ->with('success', 'Votre commande a été enregistrée avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Une erreur est survenue lors de la création de la commande.');
        }
    }

    public function index()
    {
        $orders = Auth::guard('client')->user()->orders()->with('produits')->latest()->get();
        return view('client.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->client_id !== Auth::guard('client')->id()) {
            abort(403);
        }
        return view('client.orders.show', compact('order'));
    }
} 