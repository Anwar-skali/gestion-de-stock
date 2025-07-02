@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>{{ isset($client) ? 'Edit Client' : 'Create Client' }}</h1>
        <a href="{{ route('clients.index') }}" class="btn btn-secondary">Back to Clients</a>
    </div>

    <form action="{{ isset($client) ? route('clients.update', $client->id) : route('clients.store') }}" method="POST">
        @csrf
        @if (isset($client))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $client->name ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $client->email ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $client->phone ?? '') }}">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                {{ isset($client) ? 'Update' : 'Save' }}
            </button>
        </div>
    </form>
@endsection