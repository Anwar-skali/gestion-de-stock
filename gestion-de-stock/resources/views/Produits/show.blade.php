@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ $produit->name }}</h1>
                <p class="lead">{{ $produit->description }}</p>
                <p><strong>Price:</strong> ${{ number_format($produit->price, 2) }}</p>
                <p><strong>Quantity:</strong> {{ $produit->quantity }}</p>
                
                <div class="mt-4">
                    <a href="{{ route('produits.edit', $produit) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('produits.destroy', $produit) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection