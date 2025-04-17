<!-- resources/views/dashboard.blade.php -->
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
    .section {
        margin-top: 30px;
    }
    .empty-card {
        border: 1px dashed #ccc;
        border-radius: 15px;
        text-align: center;
        padding: 40px;
        background-color: #fff;
        color: #888;
        font-size: 16px;
    }
    .shortcut {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #3d0072;
        text-decoration: none;
        padding: 8px 15px;
        border-radius: 5px;
        transition: background-color 0.2s;
    }
    .shortcut:hover {
        background-color: rgba(61, 0, 114, 0.1);
        color: #3d0072;
    }
    .shortcut i {
        font-size: 1.1rem;
    }
    .btn-primary {
        background-color: #3d0072;
        border-color: #3d0072;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-primary:hover {
        background-color: #2b0052;
        border-color: #2b0052;
    }
    .btn-primary i {
        font-size: 1.1rem;
    }
    footer {
        display: none !important;
    }
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .card-body {
        padding: 1rem;
    }
    .card-title {
        color: #3d0072;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }
    .card-text {
        font-size: 0.8rem;
    }
    .btn-outline-primary {
        color: #3d0072;
        border-color: #3d0072;
    }
    .btn-outline-primary:hover {
        background-color: #3d0072;
        color: white;
    }
    .badge {
        font-size: 0.7rem;
        padding: 0.35em 0.65em;
    }
    .btn-link {
        color: #3d0072;
    }
    .btn-link:hover {
        color: #2b0052;
    }
</style>

<x-sidebar />

<div class="content" id="content">
    <div class="topbar">
        <div class="d-flex align-items-center">
            <div>
                <h5 class="mb-1">Salut {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} !</h5>
            </div>
        </div>
        <a href="#" class="user-circle">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</a>
        @include('profile')
    </div>

    <!-- Sections -->
    <div class="section">
        <a href="{{ route('parapheur.create') }}" class="shortcut"><i class="bi bi-folder-plus"></i> Nouveau parapheur</a>
        <a href="/contacts/create" class="shortcut"><i class="bi bi-person-plus-fill"></i> Nouveau contact</a>
    </div>
    <div class="section">
        <h5>Parapheurs</h5>
        @if($parapheurs->count())
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-5 g-4">
                @foreach($parapheurs->take(5) as $p)
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="card-title">{{ $p->nom }}</h6>
                                <p class="card-text small text-muted">
                                    {{ $p->documents_count }} document(s)
                                </p>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('parapheur.show', $p) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-end mt-3">
                <a href="{{ route('parapheur.index') }}" class="btn btn-link text-decoration-none">
                    Voir tous les parapheurs <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        @else
            <div class="empty-card">Aucun parapheur</div>
        @endif
    </div>

    <div class="section">
        <h5>Contacts</h5>
        @if($contacts && $contacts->count())
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-5 g-4">
                @foreach($contacts->take(5) as $contact)
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="card-title">{{ $contact->name }}</h6>
                                <p class="card-text small text-muted">
                                    {{ $contact->email }}
                                </p>
                                <div class="d-flex justify-content-between">
                                    <a href="/contacts/{{ $contact->id }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-end mt-3">
                <a href="{{ route('contacts.index') }}" class="btn btn-link text-decoration-none">
                    Voir tous les contacts <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        @else
            <div class="empty-card">Aucun contact</div>
        @endif
    </div>

    <div class="section">
        <h5>Documents</h5>
        @if($documents->count())
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-5 g-4">
                @foreach($documents->take(5) as $doc)
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="card-title">{{ $doc->titre }}</h6>
                                <p class="card-text small text-muted">
                                    {{ $doc->created_at->format('d/m/Y') }}
                                </p>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('documents.show', $doc) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-end mt-3">
                <a href="{{ route('documents.index') }}" class="btn btn-link text-decoration-none">
                    Voir tous les documents <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        @else
            <div class="empty-card">Aucun document</div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
@endsection
