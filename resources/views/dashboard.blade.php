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
        display: inline-block;
        margin-right: 20px;
        color: #3d0072;
        text-decoration: none;
    }
    .shortcut i {
        margin-right: 5px;
        font-size: 1rem;
    }
</style>

<x-sidebar />

<div class="content" id="content">
    <div class="topbar">
        <div class="d-flex align-items-center">
            <div>
                <h5 class="mb-1">Salut {{ Auth::user()->name }} !</h5>
            </div>
        </div>
        <a href="#" class="user-circle">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</a>
        @include('profile')
      </div>

    <!-- Sections -->
    <div class="section">
        <a href="#" class="shortcut"><i class="bi bi-folder-plus"></i> Nouveau parapheur</a>
        <a href="#" class="shortcut"><i class="bi bi-person-plus-fill"></i> Nouveau contact</a>
    </div>
    <div class="section">
        <h5>Parapheurs</h5>
        <div class="empty-card">Aucun parapheur</div>
    </div>

    <div class="section">
        <h5>Contacts</h5>
        <div class="empty-card">Aucun contact</div>
    </div>

    <div class="section">
  <h5>Documents</h5>
  @if($documents->count())
    <ul class="list-group">
      @foreach($documents as $doc)
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <span>{{ $doc->titre }}</span>
          <a href="{{ asset('storage/documents/' . $doc->fichier) }}" target="_blank" class="btn btn-sm btn-primary">
            <i class="bi bi-eye"></i> Voir
          </a>
        </li>
      @endforeach
    </ul>
  @else
    <div class="empty-card">Aucun document</div>
  @endif
</div>

</div>
@endsection
