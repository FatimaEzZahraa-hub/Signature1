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
    .document-info {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }
    .info-row {
        display: flex;
        margin-bottom: 15px;
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
    }
    .info-label {
        width: 150px;
        font-weight: 500;
        color: #666;
    }
    .info-value {
        flex: 1;
        color: #333;
    }
    .signataire-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        padding: 10px;
        background: #f8f9fa;
        border-radius: 8px;
    }
    .signataire-item i {
        margin-right: 10px;
        color: #3d0072;
    }
    .action-buttons {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }
    .action-buttons .btn i {
        margin-right: 8px;
    }
</style>

<x-sidebar />

<div class="content" id="content">
    <div class="topbar">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('documents.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h5 class="mb-0">Détails du document</h5>
        </div>
        <a href="#" class="user-circle">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</a>
        @include('profile')
    </div>

    <div class="document-info">
        <div class="info-row">
            <div class="info-label">Nom du document</div>
            <div class="info-value">{{ $document->name }}</div>
        </div>

        <div class="info-row">
            <div class="info-label">Statut</div>
            <div class="info-value">
                <span class="badge 
                    @if($document->status=='signé') bg-success 
                    @elseif($document->status=='en attente') bg-warning 
                    @else bg-secondary @endif">
                    {{ ucfirst($document->status) }}
                </span>
            </div>
        </div>

        <div class="info-row">
            <div class="info-label">Date de création</div>
            <div class="info-value">{{ $document->created_at->format('d/m/Y H:i') }}</div>
        </div>

        <div class="info-row">
            <div class="info-label">Dernière modification</div>
            <div class="info-value">{{ $document->updated_at->format('d/m/Y H:i') }}</div>
        </div>

        <div class="info-row">
            <div class="info-label">Signataires</div>
            <div class="info-value">
                @forelse($document->signataires as $signataire)
                    <div class="signataire-item">
                        <i class="bi bi-person-circle"></i>
                        <div>
                            <div>{{ $signataire->name }}</div>
                            <small class="text-muted">{{ $signataire->email }}</small>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">Aucun signataire</p>
                @endforelse
            </div>
        </div>

        <div class="action-buttons">
            <a href="{{ route('documents.download', $document) }}" class="btn btn-primary">
                <i class="bi bi-download"></i> Télécharger
            </a>
            <button class="btn btn-outline-danger">
                <i class="bi bi-trash"></i> Supprimer
            </button>
        </div>
    </div>
</div>
@endsection 