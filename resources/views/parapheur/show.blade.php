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
        background-color: #f3f3f3;
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
        padding: 15px 20px;
        background-color: #fff;
        border-radius: 10px;
    }
    .topbar h5 {
        color: #3d0072;
        margin: 0;
        font-weight: 600;
    }
    .btn-light {
        background-color: #f8f9fa;
        border-color: #dee2e6;
        color: #3d0072;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .btn-light:hover {
        background-color: #e2e6ea;
        border-color: #dae0e5;
        color: #3d0072;
    }
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }
    .card-header {
        background-color: #3d0072;
        color: white;
        border-radius: 15px 15px 0 0;
        padding: 15px 20px;
        font-weight: 500;
    }
    .card-body {
        padding: 20px;
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
    .btn-outline-primary {
        color: #3d0072;
        border-color: #3d0072;
    }
    .btn-outline-primary:hover {
        background-color: #3d0072;
        border-color: #3d0072;
        color: white;
    }
    .btn-outline-success {
        color: #28a745;
        border-color: #28a745;
    }
    .btn-outline-success:hover {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
    }
    .btn-outline-danger {
        color: #dc3545;
        border-color: #dc3545;
    }
    .btn-outline-danger:hover {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
    }
    .table {
        margin-bottom: 0;
    }
    .table th {
        color: #3d0072;
        font-weight: 500;
        border-top: none;
    }
    .table td {
        vertical-align: middle;
    }
    .btn-outline-primary, .btn-outline-success, .btn-outline-danger {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
    .table-container {
        margin-bottom: 20px;
    }
    .empty-table-message {
        text-align: center;
        padding: 20px;
        color: #666;
    }
</style>

<x-sidebar />

<div class="content" id="content">
  <div class="topbar">
    <a href="{{ route('parapheur.index') }}" class="btn btn-light">
      <i class="bi bi-arrow-left"></i> Retour
    </a>
    <h5>Détails du Parapheur: {{ $parapheur->nom }}</h5>
  </div>

  <div class="section">
    <div class="card mb-4">
      <div class="card-header">Informations Générales</div>
      <div class="card-body">
        <p><strong>Nom :</strong> {{ $parapheur->nom }}</p>
        <p><strong>Date de création :</strong> {{ $parapheur->created_at->format('d/m/Y') }}</p>
        <p><strong>Statut global :</strong>
          @if($parapheur->status=='en_attente')
            En attente
          @else
            Signé
          @endif
        </p>
        <p><strong>Description :</strong> {{ $parapheur->description ?: '-' }}</p>
        <a href="{{ route('parapheur.edit', $parapheur) }}" class="btn btn-primary">Modifier le Parapheur</a>
      </div>
    </div>

    <div class="card">
      <div class="card-header">Documents</div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th>Nom du document</th>
              <th>Status</th>
              <th>Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
          @foreach($parapheur->documents as $doc)
            <tr>
              <td>{{ $doc->titre }}</td>
              <td>
                <span class="badge {{ $doc->pivot->status === 'signé' ? 'bg-success' : 'bg-warning' }}">
                  {{ $doc->pivot->status === 'signé' ? 'Signé' : 'En attente' }}
                </span>
              </td>
              <td>{{ $doc->pivot->updated_at->format('d/m/Y') }}</td>
              <td>
                <a href="{{ route('documents.show',$doc) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                <a href="{{ route('documents.download',$doc) }}" class="btn btn-sm btn-outline-success"><i class="bi bi-download"></i></a>
                <form action="{{ route('parapheur.document.remove',[$parapheur,$doc]) }}"
                      method="POST" class="d-inline">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                </form>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
        @if($parapheur->documents->isEmpty())
          <div class="empty-table-message">
            Aucun document n'a été ajouté à ce parapheur.
          </div>
        @endif
      </div>
    </div>

    <div class="d-flex justify-content-start">
      <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAddDocument">
        <i class="bi bi-plus-lg"></i> Ajouter un document
      </button>
    </div>
  </div>
</div>

@include('parapheur._modal_add_document')

@endsection
