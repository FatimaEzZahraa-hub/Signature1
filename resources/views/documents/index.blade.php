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
        gap: 10px;
        flex-wrap: wrap;
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
                    <input class="form-control me-2" type="search" name="q" placeholder="Recherche par nom de document">
                    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                </form>
                <button class="btn btn-outline-secondary"><i class="bi bi-funnel"></i> Filtrer</button>
                <button class="btn btn-outline-secondary"><i class="bi bi-sort-alpha-down"></i> Trier</button>
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
                                <span class="d-inline-block me-1" title="{{ $sig->name }}">
                                    <i class="bi bi-circle-fill text-info"></i>
                                </span>
                            @endforeach
                        </td>
                        <td>{{ $doc->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('documents.download', $doc) }}" class="me-2"><i class="bi bi-download"></i></a>
                            <a href="{{ route('documents.show', $doc) }}"><i class="bi bi-info-circle"></i></a>
                            <a href="#" onclick="toggleDocumentViewer('{{ asset('storage/documents/'.$doc->fichier) }}', '{{ $doc->name }}')">
                                <i class="bi bi-eye"></i>
                            </a>

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
@endsection
