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
    .create-form {
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        padding: 2rem;
        max-width: 600px;
        margin: 0 auto;
    }
    .form-label {
        color: #666;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    .form-control {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 0.5rem 0.75rem;
    }
    .form-control:focus {
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
    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        padding: 0.5rem 1.5rem;
    }
    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }
</style>

<x-sidebar />

<div class="content" id="content">
    <div class="topbar">
        <h5 class="mb-0">Ajouter un Contact</h5>
        <a href="#" class="user-circle">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</a>
        @include('profile')
    </div>

    <div class="create-form">
        <form id="createContactForm" action="/contacts" method="POST">
            @csrf
            <meta name="csrf-token" content="{{ csrf_token() }}">
            
            <div class="mb-3">
                <label for="nom" class="form-label">Nom*</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>

            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom*</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email*</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="tel" class="form-control" id="telephone" name="telephone">
            </div>

            <div class="d-flex justify-content-between">
                <a href="/contacts" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('createContactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData();
    const nom = document.getElementById('nom').value;
    const prenom = document.getElementById('prenom').value;
    const email = document.getElementById('email').value;
    const telephone = document.getElementById('telephone').value;
    
    // Combiner nom et prénom
    formData.append('name', `${prenom} ${nom}`);
    formData.append('email', email);
    formData.append('telephone', telephone);
    
    fetch('/contacts', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => {
        if (response.ok) {
            window.location.href = '/contacts';
        } else {
            throw new Error('Erreur lors de la création du contact');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
    });
});
</script>
@endsection 