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
        <a href="#" class="shortcut"><i class="bi bi-folder-plus"></i> Nouveau parapheur</a>
        <a href="/contacts/create" class="shortcut"><i class="bi bi-person-plus-fill"></i> Nouveau contact</a>
    </div>
    <div class="section">
        <h5>Parapheurs</h5>
        <div class="empty-card">Aucun parapheur</div>
    </div>

    <div class="section">
        <h5>Contacts</h5>
        @if($contacts && $contacts->count())
            <ul class="list-group">
                @foreach($contacts as $contact)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $contact->name }}</span>
                        <div>
                            <span class="text-muted me-3">{{ $contact->email }}</span>
                            <a href="/contacts/{{ $contact->id }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-eye"></i> Voir
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="text-end mt-3">
                <a href="{{ route('contacts.index') }}" class="btn btn-link text-decoration-none">
                    Voir tous les contacts <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        @else
            <div class="empty-card">
                <p class="mb-3">Aucun contact</p>
            </div>
        @endif
    </div>

    <div class="section">
        <h5>Documents</h5>
        @if($documents->count())
            <ul class="list-group">
                @foreach($documents as $doc)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $doc->titre }}</span>
                        <a href="{{ route('documents.show', $doc) }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-eye"></i> Voir
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="text-end mt-3">
                <a href="{{ route('documents.index') }}" class="btn btn-link text-decoration-none">
                    Voir tous les contacts <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        @else
            <div class="empty-card">Aucun document</div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
@endsection
