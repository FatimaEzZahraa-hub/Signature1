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
    .inbox-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .inbox-tabs {
        display: flex;
        gap: 20px;
        border-bottom: 1px solid #eee;
        margin-bottom: 20px;
    }
    .inbox-tab {
        padding: 10px 0;
        color: #666;
        text-decoration: none;
        position: relative;
        font-weight: 500;
    }
    .inbox-tab.active {
        color: #3d0072;
    }
    .inbox-tab.active::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        right: 0;
        height: 2px;
        background-color: #3d0072;
    }
    .document-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .document-card {
        background: white;
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .document-info {
        flex: 1;
    }
    .document-title {
        font-weight: 500;
        color: #333;
        margin-bottom: 5px;
    }
    .document-meta {
        font-size: 0.9rem;
        color: #666;
    }
    .document-status {
        padding: 4px 12px;
        border-radius: 15px;
        font-size: 0.85rem;
        font-weight: 500;
    }
    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }
    .document-actions {
        display: flex;
        gap: 10px;
    }
    .btn-sign {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        text-decoration: none;
        font-size: 0.9rem;
    }
    .btn-sign:hover {
        background-color: #218838;
        color: white;
    }
    .btn-reject {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        text-decoration: none;
        font-size: 0.9rem;
    }
    .btn-reject:hover {
        background-color: #c82333;
        color: white;
    }
    .btn-view {
        background-color: #17a2b8;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        text-decoration: none;
        font-size: 0.9rem;
    }
    .btn-view:hover {
        background-color: #138496;
        color: white;
    }
    .select-all {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }
    .select-all input[type="checkbox"] {
        width: 18px;
        height: 18px;
    }
</style>

<x-sidebar />

<div class="content" id="content">
    <div class="topbar">
        <h5 class="mb-0">Boîte de Réception</h5>
        <a href="#" class="user-circle">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</a>
        @include('profile')
    </div>

    <div class="inbox-tabs">
        <a href="#" class="inbox-tab active">Action requise</a>
        <a href="#" class="inbox-tab">Complétées</a>
    </div>

    <div class="select-all">
        <input type="checkbox" id="selectAll">
        <label for="selectAll">Sélectionner tout</label>
    </div>

    <div class="document-list">
        @foreach($documents as $document)
        <div class="document-card">
            <input type="checkbox" class="document-checkbox" style="margin-right: 15px;">
            
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
</script>
@endpush
@endsection 