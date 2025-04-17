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
    }
    main {
        flex: 1;
    }
    footer {
        display: none !important;
    }
    .topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        padding: 10px 20px;
        background-color: #fff;
        border-radius: 10px;
    }
    .user-circle {
        background-color: #3d0072;
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        text-decoration: none;
    }
    .edit-form {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }
    .form-label {
        color: #666;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    .form-control, .form-select {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 0.5rem 0.75rem;
    }
    .form-control:focus, .form-select:focus {
        border-color: #3d0072;
        box-shadow: 0 0 0 0.2rem rgba(61, 0, 114, 0.25);
    }
    .btn-primary {
        background-color: #3d0072;
        border-color: #3d0072;
        padding: 0.5rem 1.5rem;
    }
    .btn-primary:hover {
        background-color: #2b0052;
        border-color: #2b0052;
    }
    .form-select[multiple] {
        height: auto;
        min-height: 200px;
    }
</style>

<x-sidebar />

<div class="content" id="content">
    <div class="topbar">
        <h5 class="mb-0">Modifier le Parapheur</h5>
        <a href="#" class="user-circle">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</a>
        @include('profile')
    </div>

    <div class="edit-form">
        <form action="{{ route('parapheur.update', $parapheur) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="nom" class="form-label">Nom du Parapheur</label>
                <input type="text" class="form-control" id="nom" name="nom" value="{{ $parapheur->nom }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ $parapheur->description }}</textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('parapheur.show', $parapheur) }}" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>

@endsection 