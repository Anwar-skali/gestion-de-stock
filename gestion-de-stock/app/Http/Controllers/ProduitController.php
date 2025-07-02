<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProduitController extends Controller
{
    // List all produits
    public function index()
    {
        $produits = Produit::all();
        return view('produits.index', compact('produits'));
    }

    // Show the create form
    public function create()
    {
        return view('produits.create');
    }

    // Save a new produit
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/products', $imageName);
            $data['image'] = 'products/' . $imageName;
        }

        // Create the produit
        Produit::create($data);

        // Redirect with a success message
        return redirect()->route('produits.index')->with('success', 'Produit created successfully.');
    }

    // Show a single produit
    public function show(Produit $produit)
    {
        return view('produits.show', compact('produit'));
    }

    // Show the edit form
    public function edit(Produit $produit)
    {
        return view('produits.edit', compact('produit'));
    }

    // Update a produit
    public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($produit->image) {
                Storage::delete('public/' . $produit->image);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/products', $imageName);
            $data['image'] = 'products/' . $imageName;
        }

        $produit->update($data);

        return redirect()->route('produits.index')->with('success', 'Produit updated successfully.');
    }

    // Delete a produit
    public function destroy(Produit $produit)
    {
        $produit->delete();
        return redirect()->route('produits.index')->with('success', 'Produit deleted successfully.');
    }
}