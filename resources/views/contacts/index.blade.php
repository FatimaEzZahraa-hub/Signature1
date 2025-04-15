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
    .contact-list {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }
    .contact-header {
        display: grid;
        grid-template-columns: 2fr 1.5fr 1fr 100px;
        padding: 15px;
        border-bottom: 1px solid #eee;
        font-weight: 500;
        color: #666;
    }
    .contact-row {
        display: grid;
        grid-template-columns: 2fr 1.5fr 1fr 100px;
        padding: 15px;
        border-bottom: 1px solid #eee;
        align-items: center;
    }
    .contact-row:last-child {
        border-bottom: none;
    }
    .contact-actions {
        display: flex;
        gap: 10px;
    }
    .contact-actions i {
        cursor: pointer;
        color: #666;
        font-size: 1.1rem;
        padding: 5px;
        border-radius: 4px;
        transition: all 0.2s ease;
    }
    .contact-actions .edit-icon {
        color: #3d0072;
    }
    .contact-actions .delete-icon {
        color: #dc3545;
    }
    .contact-actions i:hover {
        background-color: rgba(0, 0, 0, 0.05);
    }
    .btn-add-contact {
        background-color: #3d0072;
        color: white !important;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        margin-bottom: 20px;
        text-decoration: none;
        font-size: 0.9rem;
        transition: background-color 0.2s ease;
    }
    .btn-add-contact i {
        font-size: 1.1rem;
    }
    .btn-add-contact:hover {
        background-color: #2b0052;
        color: white !important;
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
</style>

<x-sidebar />

<div class="content" id="content">
    <div class="topbar">
        <h5 class="mb-0">Contacts</h5>
        <a href="#" class="user-circle">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</a>
        @include('profile')
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <a href="/contacts/create" class="btn btn-add-contact">
        <i class="bi bi-person-plus-fill"></i>
        <span>Nouveau Contact</span>
    </a>

    <div class="contact-list">
        <div class="contact-header">
            <div>Nom complet</div>
            <div>Email</div>
            <div>Téléphone</div>
            <div>Actions</div>
        </div>
        @forelse($contacts as $contact)
        <div class="contact-row" id="contact-{{ $contact->id }}">
            <div>{{ $contact->name }}</div>
            <div>{{ $contact->email }}</div>
            <div>{{ $contact->telephone ?? 'Non renseigné' }}</div>
            <div class="contact-actions">
                <a href="/contacts/{{ $contact->id }}/edit" class="text-decoration-none">
                    <i class="bi bi-pencil-fill edit-icon"></i>
                </a>
                <button type="button" class="delete-btn" onclick="showDeleteConfirmation({{ $contact->id }})">
                    <i class="bi bi-trash-fill delete-icon"></i>
                </button>
            </div>
        </div>
        @empty
        <div class="contact-row">
            <div colspan="4" class="text-center text-muted">Aucun contact</div>
        </div>
        @endforelse
    </div>
</div>

<!-- Modal Confirmation Suppression -->
<div class="modal-backdrop" id="deleteModalBackdrop"></div>
<div class="delete-confirm-modal" id="deleteConfirmModal">
    <div class="modal-title">
        <i class="bi bi-exclamation-triangle text-warning"></i>
        Confirmer la suppression
    </div>
    <div class="modal-body">
        Êtes-vous sûr de vouloir supprimer ce contact ? Cette action est irréversible.
    </div>
    <div class="modal-footer">
        <button type="button" class="btn-cancel" onclick="hideDeleteConfirmation()">Annuler</button>
        <button type="button" class="btn-delete" onclick="deleteContact()">Supprimer</button>
    </div>
</div>

<script>
let currentContactId = null;

function showDeleteConfirmation(id) {
    currentContactId = id;
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
    currentContactId = null;
}

function deleteContact() {
    if (!currentContactId) return;
    
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    fetch(`/contacts/${currentContactId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (response.ok) {
            const element = document.getElementById(`contact-${currentContactId}`);
            if (element) {
                element.remove();
            }
            hideDeleteConfirmation();
            if (document.querySelectorAll('.contact-row').length === 0) {
                location.reload();
            }
        } else {
            throw new Error('Erreur lors de la suppression');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        hideDeleteConfirmation();
    });
}

// Fermer le modal si on clique en dehors
document.getElementById('deleteModalBackdrop').addEventListener('click', hideDeleteConfirmation);
</script>
@endsection 