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
    .card {
        border-radius: 15px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }
    .card-header {
        background-color: #3d0072;
        color: white;
        border-radius: 15px 15px 0 0;
    }
    .btn-admin {
        background-color: #3d0072;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-admin:hover {
        background-color: #2b0052;
        color: white;
    }
    footer {
        display: none !important;
    }
</style>

<x-admin-sidebar />

<div class="content" id="content">
    <div class="topbar">
        <div class="d-flex align-items-center">
            <div>
                <h5 class="mb-1">Salut {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} !</h5>
                <p class="text-muted mb-0">Administrateur</p>
            </div>
        </div>
        <a href="#" class="user-circle">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</a>
        @include('profile')
    </div>

    <!-- Gestion des utilisateurs -->
    <div class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Gestion des utilisateurs</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <a href="{{ route('admin.etudiants.index') }}" class="btn-admin">
                            <i class="bi bi-people"></i> Gérer les étudiants
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('admin.enseignants.index') }}" class="btn-admin">
                            <i class="bi bi-person-badge"></i> Gérer les enseignants
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('admin.activites') }}" class="btn-admin">
                            <i class="bi bi-activity"></i> Voir les activités
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Statistiques</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="text-center">
                            <h3>{{ $totalEtudiants ?? 0 }}</h3>
                            <p class="text-muted">Étudiants</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <h3>{{ $totalEnseignants ?? 0 }}</h3>
                            <p class="text-muted">Enseignants</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <h3>{{ $totalDocuments ?? 0 }}</h3>
                            <p class="text-muted">Documents</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 