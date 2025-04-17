{{-- resources/views/documents/index.blade.php --}}
@extends('layouts.app') {{-- ou ton layout principal --}}

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
    .section {
        margin-top: 30px;
    }
    .btn i {
        font-size: 1rem;
        margin-right: 5px;
    }
    .table i {
        font-size: 1.1rem;
    }
    .search-form {
        flex: 1;
        min-width: 200px;
    }
    .action-buttons {
        display: flex;
        gap: 2px;
    }
    .action-buttons .btn-link {
        padding: 0;
    }
    .table-responsive {
        overflow-x: auto;
    }
    @media (max-width: 768px) {
        .content {
            margin-left: 0;
            padding: 15px;
        }
        .topbar {
            flex-direction: column;
            align-items: flex-start;
        }
        .search-form {
            width: 100%;
        }
        .action-buttons {
            width: 100%;
            justify-content: space-between;
        }
        .table th, .table td {
            white-space: nowrap;
        }
    }
    .filter-dropdown {
        min-width: 200px;
        padding: 10px;
    }
    .filter-option {
        padding: 8px 15px;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    .filter-option:hover {
        background-color: #f8f9fa;
    }
    .filter-option.active {
        background-color: #e9ecef;
    }
    .sort-dropdown {
        min-width: 200px;
        padding: 10px;
    }
    .sort-option {
        padding: 8px 15px;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    .sort-option:hover {
        background-color: #f8f9fa;
    }
    .sort-option.active {
        background-color: #e9ecef;
    }
</style>

<x-sidebar />

<div class="content" id="content">
  <div class="topbar">
    <h5 class="mb-1">Documents</h5>
    <a href="#" class="user-circle">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</a>
        @include('profile')
  </div>

  <div class="section">
    <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center gap-2">
      <form class="d-flex" action="{{ route('documents.index') }}" method="GET">
                    <input class="form-control me-2" type="search" name="q" placeholder="Recherche par nom de document" value="{{ request('q') }}">
        <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
      </form>
                
                <!-- Dropdown pour le filtre -->
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-funnel"></i> Filtrer
                    </button>
                    <ul class="dropdown-menu filter-dropdown" aria-labelledby="filterDropdown">
                        <li>
                            <a class="dropdown-item filter-option {{ request('status') == '' ? 'active' : '' }}" 
                               href="{{ route('documents.index', array_merge(request()->except('status'), ['status' => ''])) }}">
                                Tous les statuts
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item filter-option {{ request('status') == 'signé' ? 'active' : '' }}" 
                               href="{{ route('documents.index', array_merge(request()->except('status'), ['status' => 'signé'])) }}">
                                Signés
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item filter-option {{ request('status') == 'en attente' ? 'active' : '' }}" 
                               href="{{ route('documents.index', array_merge(request()->except('status'), ['status' => 'en attente'])) }}">
                                En attente
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item filter-option {{ request('status') == 'brouillon' ? 'active' : '' }}" 
                               href="{{ route('documents.index', array_merge(request()->except('status'), ['status' => 'brouillon'])) }}">
                                Brouillons
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Dropdown pour le tri -->
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-sort-alpha-down"></i> Trier
                    </button>
                    <ul class="dropdown-menu sort-dropdown" aria-labelledby="sortDropdown">
                        <li>
                            <a class="dropdown-item sort-option {{ request('sort') == 'date_desc' ? 'active' : '' }}" 
                               href="{{ route('documents.index', array_merge(request()->except('sort'), ['sort' => 'date_desc'])) }}">
                                Date (plus récent)
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item sort-option {{ request('sort') == 'date_asc' ? 'active' : '' }}" 
                               href="{{ route('documents.index', array_merge(request()->except('sort'), ['sort' => 'date_asc'])) }}">
                                Date (plus ancien)
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item sort-option {{ request('sort') == 'name_asc' ? 'active' : '' }}" 
                               href="{{ route('documents.index', array_merge(request()->except('sort'), ['sort' => 'name_asc'])) }}">
                                Nom (A-Z)
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item sort-option {{ request('sort') == 'name_desc' ? 'active' : '' }}" 
                               href="{{ route('documents.index', array_merge(request()->except('sort'), ['sort' => 'name_desc'])) }}">
                                Nom (Z-A)
                            </a>
                        </li>
                    </ul>
                </div>
      </div>
      <a href="{{ route('documents.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i></a>
    </div>

    <table class="table table-hover bg-white rounded shadow-sm">
      <thead>
        <tr>
          <th>Nom du document</th>
          <th>Statut</th>
          <th>Signataires</th>
          <th>Créer le</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($documents as $doc)
          <tr>
                        <td>{{ $doc->titre }}</td>
            <td>
              <span class="badge 
                @if($doc->status=='signé') bg-success 
                @elseif($doc->status=='en attente') bg-warning 
                @else bg-secondary @endif">
                {{ ucfirst($doc->status) }}
              </span>
            </td>
            <td>
              @foreach($doc->signataires as $sig)
                                <span class="d-inline-block me-1" title="{{ $sig->name }} ({{ $sig->email }})">
                  <i class="bi bi-circle-fill text-info"></i>
                                    {{ $sig->name }}
                </span>
              @endforeach
                            @if($doc->signataires->isEmpty())
                                <span class="text-muted">Aucun signataire</span>
                            @endif
            </td>
            <td>{{ $doc->created_at->format('d/m/Y') }}</td>
            <td>
                            <div class="action-buttons">
                                <a href="{{ route('documents.download', $doc) }}" class="btn btn-link text-primary" title="Télécharger">
                                    <i class="bi bi-download"></i>
                                </a>
                                <a href="{{ route('documents.show', $doc) }}" class="btn btn-link text-info" title="Détails">
                                    <i class="bi bi-info-circle"></i>
                                </a>
                                <a href="#" onclick="toggleDocumentViewer('{{ asset('storage/' . $doc->fichier) }}', '{{ $doc->titre }}')" class="btn btn-link text-success" title="Voir">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center py-5 text-muted">
              Aucun document
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
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
