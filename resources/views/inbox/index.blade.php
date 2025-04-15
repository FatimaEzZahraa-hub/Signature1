@extends('layouts.app')

@section('content')
@push('styles')
<link href="{{ asset('css/inbox.css') }}" rel="stylesheet">
@endpush

<x-sidebar />

<div class="content" id="content">
    <div class="topbar">
        <h5 class="mb-0">Boîte de Réception</h5>
        <div class="d-flex align-items-center gap-3">
            <div class="column-selector">
                <button class="column-selector-btn" onclick="toggleColumnSelector()">
                    <i class="bi bi-columns-gap"></i>
                    Colonnes
                </button>
                <div class="column-selector-dropdown" id="columnSelector">
                    <div class="column-option">
                        <input type="checkbox" id="colDate" checked>
                        <label for="colDate">Date de réception</label>
                    </div>
                    <div class="column-option">
                        <input type="checkbox" id="colSender" checked>
                        <label for="colSender">Expéditeur</label>
                    </div>
                    <div class="column-option">
                        <input type="checkbox" id="colStatus" checked>
                        <label for="colStatus">Statut</label>
                    </div>
                    <div class="column-option">
                        <input type="checkbox" id="colActions" checked>
                        <label for="colActions">Actions</label>
                    </div>
                </div>
            </div>
            <a href="#" class="user-circle">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</a>
            @include('profile')
        </div>
    </div>

    <div class="boite-de-reception-tabs">
        <a href="#" class="boite-de-reception-tab active">Action requise</a>
        <a href="#" class="boite-de-reception-tab">Complétées</a>
    </div>

    <div class="select-all">
        <input type="checkbox" id="selectAll">
        <label for="selectAll">Sélectionner tout</label>
    </div>

    <div class="document-list">
        @foreach($documents as $document)
        <div class="document-card">
            <input type="checkbox" class="document-checkbox">
            
            <div class="document-info">
                <div class="document-title">{{ $document->titre }}</div>
                <div class="document-meta">
                    De : {{ $document->sender_email }}<br>
                    Reçu le : {{ $document->created_at->format('Y-m-d') }}
                </div>
            </div>

            <div class="document-status status-pending">
                Statut : En attente
            </div>

            <div class="document-actions">
                <a href="#" class="btn-sign" onclick="showSignatureModal({{ $document->id }})">
                    <i class="bi bi-pen"></i>
                    Signer
                </a>
                <a href="#" class="btn-reject" onclick="rejectDocument({{ $document->id }})">
                    <i class="bi bi-x-circle"></i>
                    Refuser
                </a>
                <a href="#" class="btn-view" onclick="viewDocument({{ $document->id }})">
                    <i class="bi bi-eye"></i>
                    Voir
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal de signature -->
<div class="modal fade" id="signatureModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Signer le document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="signaturePad"></div>
                <input type="hidden" id="documentId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="clearSignature()">Effacer</button>
                <button type="button" class="btn btn-primary" onclick="saveSignature()">Signer</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script>
let signaturePad;
let currentDocumentId;

document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.getElementById('signaturePad');
    signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(255, 255, 255)'
    });

    // Gérer la sélection de tous les documents
    document.getElementById('selectAll').addEventListener('change', function(e) {
        document.querySelectorAll('.document-checkbox').forEach(checkbox => {
            checkbox.checked = e.target.checked;
        });
    });
});

function showSignatureModal(documentId) {
    currentDocumentId = documentId;
    const modal = new bootstrap.Modal(document.getElementById('signatureModal'));
    modal.show();
}

function clearSignature() {
    signaturePad.clear();
}

function saveSignature() {
    if (signaturePad.isEmpty()) {
        alert('Veuillez signer le document');
        return;
    }

    const signatureData = signaturePad.toDataURL();
    
    fetch(`/documents/${currentDocumentId}/sign`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ signature: signatureData })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    });
}

function rejectDocument(documentId) {
    if (confirm('Êtes-vous sûr de vouloir refuser ce document ?')) {
        fetch(`/documents/${documentId}/reject`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }
}

function viewDocument(documentId) {
    window.open(`/documents/${documentId}/voir`, '_blank');
}

function toggleColumnSelector() {
    const dropdown = document.getElementById('columnSelector');
    dropdown.classList.toggle('show');
}

// Fermer le dropdown si on clique en dehors
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('columnSelector');
    const button = document.querySelector('.column-selector-btn');
    if (!dropdown.contains(event.target) && !button.contains(event.target)) {
        dropdown.classList.remove('show');
    }
});

// Gérer la visibilité des colonnes
document.querySelectorAll('.column-option input[type="checkbox"]').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const columnId = this.id.replace('col', '').toLowerCase();
        const columns = document.querySelectorAll(`.document-${columnId}`);
        columns.forEach(col => {
            col.style.display = this.checked ? '' : 'none';
        });
    });
});
</script>
@endpush
@endsection 