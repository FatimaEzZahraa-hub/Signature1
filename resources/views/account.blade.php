<!-- resources/views/account.blade.php -->
@extends('layouts.app') {{-- si tu utilises un layout global --}}

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
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: none !important;
    }
    
    .card-header {
        background-color: #3d0072;
        color: white;
        border-radius: 15px 15px 0 0;
        padding: 15px 20px;
    }
    .form-control {
        border: 1px solid #3d0072;
        border-radius: 8px;
    }
    .form-control:focus {
        border-color: #3d0072;
        box-shadow: 0 0 0 0.2rem rgba(61, 0, 114, 0.25);
    }
    .btn-primary {
        background-color: #3d0072;
        border-color: #3d0072;
    }
    .btn-primary:hover {
        background-color: #3d0072;
        border-color: #3d0072;
    }
    .avatar-circle {
        width: 60px;
        height: 60px;
        background-color: #3d0072;
        color: white;
        font-weight: bold;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }
    .btn-outline-secondary:hover {
        background-color: transparent;
        color: #6c757d;
    }
</style>

<div class="container py-4 account-page">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Détail de l'utilisateur</h5>
            <button onclick="window.history.back()" class="btn btn-sm btn-light">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="card-body p-4">
            <h5 class="mb-4" style="color: #3d0072; text-decoration: underline;">Mon profil</h5>

            <form method="POST" action="{{ route('account.update') }}">
                @csrf
                @method('PUT')

                <div class="avatar-circle">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" value="{{ Auth::user()->last_name }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="prenom" class="form-control" value="{{ Auth::user()->first_name }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Numéro de téléphone</label>
                        <input type="text" name="telephone" class="form-control" value="{{ Auth::user()->phone }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Date de création</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->created_at->format('d/m/y H:i') }}" disabled>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Ancien mot de passe</label>
                        <input type="password" name="old_password" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Nouveau mot de passe</label>
                        <input type="password" name="new_password" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Confirmer le nouveau mot de passe</label>
                        <input type="password" name="new_password_confirmation" class="form-control">
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary me-2">Annuler</a>
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function changePhoto() {
  // Demander à l'utilisateur de télécharger une nouvelle photo
  const fileInput = document.createElement('input');
  fileInput.type = 'file';
  fileInput.accept = 'image/*';

  fileInput.click();
  
  fileInput.addEventListener('change', function() {
    const file = fileInput.files[0];
    if (file) {
      // Upload de la photo (vous devrez créer un endpoint pour gérer l'upload)
      const formData = new FormData();
      formData.append('photo', file);

      fetch('/upload-photo', {
        method: 'POST',
        body: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
      }).then(response => response.json())
        .then(data => {
          if (data.success) {
            // Mettre à jour l'avatar avec la nouvelle image
            document.querySelector('.rounded-circle').style.backgroundImage = `url(${data.photoUrl})`;
          }
        });
    }
  });
}

</script>
@endsection
