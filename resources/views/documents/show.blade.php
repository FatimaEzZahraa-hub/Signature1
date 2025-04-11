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
            <div class="info-value">{{ $document->titre }}</div>
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
            <button type="button" class="btn btn-outline-primary" onclick="toggleDocumentViewer('{{ asset('storage/' . $document->fichier) }}', '{{ $document->titre }}')">
                <i class="bi bi-eye"></i> Voir le document
            </button>
            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                <i class="bi bi-trash"></i> Supprimer
            </button>
        </div>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="bi bi-exclamation-triangle-fill text-warning" style="font-size: 3rem;"></i>
                <h5 class="mt-3">Êtes-vous sûr ?</h5>
                <p class="text-muted">Cette action est irréversible. Le document sera définitivement supprimé.</p>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                <form action="{{ route('documents.destroy', $document) }}" method="POST" class="d-inline" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODALE de prévisualisation -->
<div id="documentViewer" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.8); z-index:9999; justify-content:center; align-items:center;">
    <div style="background:white; padding:20px; border-radius:10px; width:95%; height:95%; position:relative; overflow:hidden; display:flex; flex-direction:column;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
            <h5 id="docTitle" class="mb-0"></h5>
            <button onclick="closeDocumentViewer()" style="background:none; border:none; font-size:24px; cursor:pointer;">&times;</button>
        </div>
        <div id="docPreviewContainer" style="flex:1; overflow:auto; position:relative;">
            <div id="zoomControls" style="position:absolute; top:10px; right:10px; z-index:1000; background:white; padding:5px; border-radius:5px; box-shadow:0 2px 5px rgba(0,0,0,0.2);">
                <button onclick="zoomIn()" class="btn btn-sm btn-outline-secondary me-1">+</button>
                <button onclick="zoomOut()" class="btn btn-sm btn-outline-secondary">-</button>
            </div>
        </div>
        <div style="margin-top:15px; text-align:center;">
            <a id="downloadBtn" href="#" download class="btn btn-primary">Télécharger</a>
        </div>
    </div>
</div>

<script>
    let currentZoom = 100;

    function zoomIn() {
        currentZoom += 25;
        updateZoom();
    }

    function zoomOut() {
        if (currentZoom > 25) {
            currentZoom -= 25;
            updateZoom();
        }
    }

    function updateZoom() {
        const container = document.getElementById('docPreviewContainer');
        const content = container.querySelector('img, iframe');
        if (content) {
            content.style.transform = `scale(${currentZoom / 100})`;
            content.style.transformOrigin = 'center top';
        }
    }

    function toggleDocumentViewer(url, name) {
        const container = document.getElementById('docPreviewContainer');
        const title = document.getElementById('docTitle');
        const download = document.getElementById('downloadBtn');

        title.innerText = name;
        download.href = url;
        currentZoom = 100;

        const extension = url.split('.').pop().toLowerCase();
        container.innerHTML = ''; // Vider avant d'ajouter

        if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(extension)) {
            const img = document.createElement('img');
            img.src = url;
            img.alt = 'Image du document';
            img.style.maxWidth = '100%';
            img.style.maxHeight = '100%';
            img.style.objectFit = 'contain';
            container.appendChild(img);

        } else if (extension === 'pdf') {
            const iframe = document.createElement('iframe');
            iframe.src = url;
            iframe.style.width = '100%';
            iframe.style.height = '100%';
            iframe.style.border = 'none';
            container.appendChild(iframe);

        } else if (['doc', 'docx', 'xls', 'xlsx'].includes(extension)) {
            const iframe = document.createElement('iframe');
            iframe.src = `https://docs.google.com/gview?url=${url}&embedded=true`;
            iframe.style.width = '100%';
            iframe.style.height = '100%';
            iframe.style.border = 'none';
            container.appendChild(iframe);

        } else {
            container.innerHTML = '<p style="text-align:center;">Aperçu non disponible pour ce type de document.<br>Vous pouvez le télécharger ci-dessous.</p>';
        }

        document.getElementById('documentViewer').style.display = 'flex';
    }

    function closeDocumentViewer() {
        document.getElementById('documentViewer').style.display = 'none';
    }
</script>
@endsection 