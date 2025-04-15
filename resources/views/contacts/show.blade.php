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
    .contact-details {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        max-width: 600px;
        margin: 0 auto;
    }
    .detail-row {
        display: flex;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #eee;
    }
    .detail-label {
        width: 120px;
        color: #666;
        font-weight: 500;
    }
    .detail-value {
        flex: 1;
    }
    .btn-back {
        background-color: #6c757d;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 5px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .btn-back:hover {
        background-color: #5a6268;
        color: white;
    }
    .btn-edit {
        background-color: #3d0072;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 5px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .btn-edit:hover {
        background-color: #2b0052;
        color: white;
    }
    .action-buttons {
        display: flex;
        gap: 10px;
        margin-top: 2rem;
    }
</style>

<x-sidebar />

<div class="content" id="content">
    <div class="topbar">
        <h5 class="mb-0">Détails du Contact</h5>
        <a href="#" class="user-circle">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</a>
        @include('profile')
    </div>

    <div class="contact-details">
        <div class="detail-row">
            <div class="detail-label">Nom complet</div>
            <div class="detail-value">{{ $contact->name }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Email</div>
            <div class="detail-value">{{ $contact->email }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Téléphone</div>
            <div class="detail-value">{{ $contact->telephone ?? 'Non renseigné' }}</div>
        </div>

        <div class="action-buttons">
            <button type="button" class="btn-back" onclick="history.back()">
                <i class="bi bi-arrow-left"></i>
                Retour
            </button>
            <a href="/contacts/{{ $contact->id }}/edit" class="btn-edit">
                <i class="bi bi-pencil-fill"></i>
                Modifier
            </a>
        </div>
    </div>
</div>
@endsection 