@extends('layouts.app')

@section('content')
<style>
    .navbar {
        display: none !important;
    }
    body {
        padding-top: 0 !important;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        background-color: #f3f3f3;
    }
    main {
        flex: 1;
    }
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    .card-header {
        background-color: #3d0072;
        color: white;
        border-radius: 15px 15px 0 0;
        padding: 15px 20px;
    }
    .form-control {
        border: 1px solid #3d0072;
        border-radius: 8px;
    }
    .form-control:focus {
        border-color: #3d0072;
        box-shadow: none !important;
    }
    .btn-primary {
        background-color: #3d0072;
        border-color: #3d0072;
    }
    .btn-primary:hover {
        background-color: #3d0072;
        border-color: #3d0072;
    }
    .btn-outline-secondary:hover {
        background-color: transparent;
        color: #6c757d;
    }
</style>

<x-sidebar />

<div class="content" id="content">
    <div class="container py-4">
        <div class="card mx-auto" style="max-width: 600px;">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Ajouter un Signataire</h5>
                <a href="{{ route('documents.create') }}" class="btn btn-sm btn-light">
                    <i class="bi bi-x-lg"></i>
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('signataires.store') }}" method="POST">
                    @csrf

                    {{-- Nom --}}
                    <div class="mb-4">
                        <label for="name" class="form-label">Nom</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            class="form-control @error('name') is-invalid @enderror" 
                            value="{{ old('name') }}" 
                            required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            value="{{ old('email') }}" 
                            required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Boutons --}}
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('documents.create') }}" class="btn btn-outline-secondary me-2">Annuler</a>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
