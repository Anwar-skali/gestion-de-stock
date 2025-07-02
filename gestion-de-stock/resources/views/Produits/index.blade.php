@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Produits</h1>
        <a href="{{ route('produits.create') }}" class="btn btn-primary">Create New Produit</a>
    </div>

    @if ($produits->isEmpty())
        <div class="alert alert-warning">No produits found. Please add a new produit.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produits as $produit)
                        <tr>
                            <td>{{ $produit->name }}</td>
                            <td>{{ Str::limit($produit->description, 50) }}</td>
                            <td>${{ number_format($produit->price, 2) }}</td>
                            <td>{{ $produit->quantity }}</td>
                            @if($produit->quantity > 0)
                                <td>
                                    <span class="badge bg-success">Disponible</span>
                                </td>
                            @else
                                <td>
                                    <span class="badge bg-danger">En rupture</span>
                                </td>
                            @endif
                            <td>
                                <a href="{{ route('produits.show', $produit) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('produits.edit', $produit) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('produits.destroy', $produit) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
