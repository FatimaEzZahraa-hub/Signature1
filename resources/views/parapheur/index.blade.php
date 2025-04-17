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
    .parapheur-list {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }
    .parapheur-header {
        display: grid;
        grid-template-columns: 2fr 1.5fr 1fr 100px;
        padding: 15px;
        border-bottom: 1px solid #eee;
        font-weight: 500;
        color: #666;
    }
    .parapheur-row {
        display: grid;
        grid-template-columns: 2fr 1.5fr 1fr 100px;
        padding: 15px;
        border-bottom: 1px solid #eee;
        align-items: center;
    }
    .parapheur-row:last-child {
        border-bottom: none;
    }
    .parapheur-actions {
        display: flex;
        gap: 10px;
    }
    .parapheur-actions i {
        cursor: pointer;
        color: #666;
        font-size: 1.1rem;
        padding: 5px;
        border-radius: 4px;
        transition: all 0.2s ease;
    }
    .parapheur-actions .view-icon {
        color: #3d0072;
    }
    .parapheur-actions .delete-icon {
        color: #dc3545;
    }
    .parapheur-actions .edit-icon {
        color: #3d0072;
    }
    .parapheur-actions .edit-icon:hover {
        color: #2b0052;
    }
    .parapheur-actions .sign-icon {
        color: #28a745;
    }
    .parapheur-actions .sign-icon:hover {
        color: #218838;
    }
    .parapheur-actions i:hover {
        background-color: rgba(0, 0, 0, 0.05);
    }
    .btn-add-parapheur {
        background-color: #3d0072;
        color: white !important;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .btn-add-parapheur i {
        font-size: 1.1rem;
    }
    .btn-add-parapheur:hover {
        background-color: #2b0052;
        color: white !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }
    .btn-add-parapheur:active {
        transform: translateY(0);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .delete-btn {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
    }
    .delete-confirm-modal {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        z-index: 1000;
        width: 90%;
        max-width: 400px;
        display: none;
    }
    .modal-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
        display: none;
    }
    .modal-title {
        color: #3d0072;
        font-size: 1.25rem;
        margin-bottom: 1rem;
    }
    .modal-body {
        padding: 1rem 0;
    }
    .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding-top: 1rem;
        border-top: 1px solid #eee;
    }
    .btn-delete {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 5px;
    }
    .btn-delete:hover {
        background-color: #c82333;
    }
    .btn-cancel {
        background-color: #6c757d;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 5px;
    }
    .btn-cancel:hover {
        background-color: #5a6268;
    }
    .badge {
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 500;
    }
    .badge.bg-warning {
        background-color: #ffc107;
        color: #000;
    }
    .badge.bg-success {
        background-color: #28a745;
        color: #fff;
    }
</style>

<x-sidebar />

<div class="content" id="content">
    <div class="topbar">
        <h5 class="mb-0">Liste des Parapheurs</h5>
        <a href="#" class="user-circle">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</a>
        @include('profile')
    </div>

    <button class="btn btn-add-parapheur" data-bs-toggle="modal" data-bs-target="#modalNewParapheur">
        <i class="bi bi-folder-plus"></i>
        <span>Nouveau Parapheur</span>
    </button>

    <div class="parapheur-list">
        <div class="parapheur-header">
            <div>Nom du Parapheur</div>
            <div>Nombre de Documents</div>
            <div>Status</div>
            <div>Actions</div>
        </div>
        @forelse($parapheurs as $p)
        <div class="parapheur-row" id="parapheur-{{ $p->id }}">
            <div>{{ $p->nom }}</div>
            <div>{{ $p->documents_count }}</div>
            <div>
                @if($p->status=='en_attente')
                    <span class="badge bg-warning">En attente</span>
                @else
                    <span class="badge bg-success">Signé</span>
                @endif
            </div>
            <div class="parapheur-actions">
                <a href="{{ route('parapheur.show', $p) }}" class="text-decoration-none">
                    <i class="bi bi-eye-fill view-icon"></i>
                </a>
                <form action="{{ route('parapheur.destroy', $p) }}" method="POST" class="d-inline delete-form">
                    @csrf 
                    @method('DELETE')
                    <button type="button" class="delete-btn" onclick="showDeleteConfirmation({{ $p->id }}, this.closest('form'))">
                        <i class="bi bi-trash-fill delete-icon"></i>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="parapheur-row">
            <div colspan="4" class="text-center text-muted">Aucun parapheur</div>
        </div>
        @endforelse
    </div>
</div>

@include('parapheur._modal_new')

<!-- Modal Confirmation Suppression -->
<div class="modal-backdrop" id="deleteModalBackdrop"></div>
<div class="delete-confirm-modal" id="deleteConfirmModal">
    <div class="modal-title">
        <i class="bi bi-exclamation-triangle text-warning"></i>
        Confirmer la suppression
    </div>
    <div class="modal-body">
        Êtes-vous sûr de vouloir supprimer ce parapheur ? Cette action est irréversible.
    </div>
    <div class="modal-footer">
        <button type="button" class="btn-cancel" onclick="hideDeleteConfirmation()">Annuler</button>
        <button type="button" class="btn-delete" onclick="deleteParapheur()">Supprimer</button>
    </div>
</div>

<script>
let currentForm = null;

function showDeleteConfirmation(id, form) {
    currentForm = form;
    const modal = document.getElementById('deleteConfirmModal');
    const backdrop = document.getElementById('deleteModalBackdrop');
    modal.style.display = 'block';
    backdrop.style.display = 'block';
}

function hideDeleteConfirmation() {
    const modal = document.getElementById('deleteConfirmModal');
    const backdrop = document.getElementById('deleteModalBackdrop');
    modal.style.display = 'none';
    backdrop.style.display = 'none';
    currentForm = null;
}

function deleteParapheur() {
    if (currentForm) {
        currentForm.submit();
        hideDeleteConfirmation();
    }
}

// Fermer le modal si on clique en dehors
document.getElementById('deleteModalBackdrop').addEventListener('click', hideDeleteConfirmation);
</script>

@endsection
