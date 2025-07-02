<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Client;
use App\Models\Order;
use Illuminate\Http\Request;
use PDF;

class FactureController extends Controller
{
    /**
     * Display a listing of the factures.
     */
    public function index()
    {
        $factures = Facture::with(['client', 'order'])->get();
        return view('factures.index', compact('factures'));
    }

    /**
     * Show the form for creating a new facture.
     */
    public function create()
    {
        $clients = Client::all();
        $orders = Order::all();
        return view('factures.create', compact('clients', 'orders'));
    }

    /**
     * Store a newly created facture in the database.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'order_id' => 'required|exists:orders,id',
            'invoice_date' => 'required|date',
            'total_amount' => 'required|numeric|min:0',
        ]);

        // Create the facture
        Facture::create($request->all());

        // Redirect with a success message
        return redirect()->route('factures.index')->with('success', 'Facture created successfully.');
    }

    /**
     * Display the specified facture.
     */
    public function show(Facture $facture)
    {
        return view('factures.show', compact('facture'));
    }

    /**
     * Show the form for editing the specified facture.
     */
    public function edit(Facture $facture)
    {
        $clients = Client::all();
        $orders = Order::all();
        return view('factures.edit', compact('facture', 'clients', 'orders'));
    }

    /**
     * Update the specified facture in the database.
     */
    public function update(Request $request, Facture $facture)
    {
        // Validate the request data
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'order_id' => 'required|exists:orders,id',
            'invoice_date' => 'required|date',
            'total_amount' => 'required|numeric|min:0',
        ]);

        // Update the facture
        $facture->update($request->all());

        // Redirect with a success message
        return redirect()->route('factures.index')->with('success', 'Facture updated successfully.');
    }

    /**
     * Remove the specified facture from the database.
     */
    public function destroy(Facture $facture)
    {
        $facture->delete();
        return redirect()->route('factures.index')->with('success', 'Facture deleted successfully.');
    }

    /**
     * Download the invoice as PDF
     */
    public function downloadPdf(Facture $facture)
    {
        $pdf = PDF::loadView('factures.pdf', compact('facture'));
        return $pdf->download('facture-' . $facture->id . '.pdf');
    }
}
