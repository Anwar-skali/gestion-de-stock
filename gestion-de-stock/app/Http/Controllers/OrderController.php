<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        // Retrieve all orders with their associated clients
        $orders = Order::with('client')->get();
        return view('orders.index', compact('orders'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        // Retrieve all clients to populate the dropdown
        $clients = Client::all();
        return view('orders.create', compact('clients'));
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'order_date' => 'required|date',
            'total_amount' => 'required|numeric|min:0',
        ]);

        // Create the order
        Order::create($request->all());

        // Redirect with a success message
        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    // Display the specified resource
    public function show(Order $order)
    {
        // Show the details of a specific order
        return view('orders.show', compact('order'));
    }

    // Show the form for editing the specified resource
    public function edit(Order $order)
    {
        // Retrieve all clients to populate the dropdown
        $clients = Client::all();
        return view('orders.edit', compact('order', 'clients'));
    }

    // Update the specified resource in storage
    public function update(Request $request, Order $order)
    {
        // Validate the incoming request data
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'total_amount' => 'required|numeric',
        ]);

        // Update the order with the validated data
        $order->update($request->all());
        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy(Order $order)
    {
        // Delete the specified order
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }

    // Mettre un produit en commande
    public function orderProduct(Request $request, Produit $produit)
    {
        // Vérifier si le produit est déjà en commande
        $existingOrder = Order::whereHas('produits', function($query) use ($produit) {
            $query->where('produit_id', $produit->id)
                  ->where('status', 'pending');
        })->first();

        if ($existingOrder) {
            return redirect()->back()->with('error', 'Ce produit est déjà en commande.');
        }

        try {
            DB::beginTransaction();

            // Créer une nouvelle commande
            $order = Order::create([
                'client_id' => 1, // Vous pouvez modifier cela selon vos besoins
                'order_date' => now(),
                'total_amount' => $produit->price,
                'status' => 'pending'
            ]);

            // Ajouter le produit à la commande
            $order->produits()->attach($produit->id, [
                'quantity' => 1,
                'price' => $produit->price
            ]);

            // Mettre à jour la quantité du produit à 0
            $produit->update(['quantity' => 0]);

            DB::commit();

            return redirect()->back()->with('success', 'Le produit a été mis en commande avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise en commande.');
        }
    }

    // Marquer une commande comme complétée
    public function completeOrder(Order $order)
    {
        try {
            DB::beginTransaction();

            // Mettre à jour le statut de la commande
            $order->update(['status' => 'completed']);

            // Mettre à jour les quantités des produits
            foreach ($order->produits as $produit) {
                $produit->update([
                    'quantity' => $produit->quantity + $produit->pivot->quantity
                ]);
            }

            DB::commit();
            return redirect()->route('orders.index')->with('success', 'La commande a été marquée comme complétée.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('orders.index')->with('error', 'Une erreur est survenue lors de la mise à jour de la commande.');
        }
    }

    public function cancelOrder(Order $order)
    {
        try {
            DB::beginTransaction();

            // Mettre à jour le statut de la commande
            $order->update(['status' => 'cancelled']);

            // Restaurer les quantités des produits
            foreach ($order->produits as $produit) {
                $produit->update([
                    'quantity' => $produit->quantity + $produit->pivot->quantity
                ]);
            }

            DB::commit();
            return redirect()->route('orders.index')->with('success', 'La commande a été annulée.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('orders.index')->with('error', 'Une erreur est survenue lors de l\'annulation de la commande.');
        }
    }
}