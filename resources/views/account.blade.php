<!-- resources/views/account.blade.php -->
@extends('layouts.app') {{-- si tu utilises un layout global --}}

@section('content')
<div class="container-fluid" style="background-color: #f3f3f3; min-height: 100vh;">
  <div class="row">
    {{-- Sidebar (on ne l'affiche pas ici) --}}
    {{-- @include('sidebar') --}}

    {{-- Contenu principal --}}
    <div class="col" style="padding: 0;">

      <!-- Barre de titre -->
      <div class="d-flex align-items-center justify-content-between px-4 py-3" style="background-color: #3d0072; color: white;">
        <h5 class="mb-0">Détail de l'utilisateur</h5>
        <button onclick="window.history.back()" class="btn btn-sm btn-light">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>

      <div class="px-5 py-4" style="background-color: white; min-height: 100%;">

        <h5 class="mb-4" style="color: #3d0072; text-decoration: underline;">Mon profil</h5>

        <form method="POST" action="{{ route('account.update') }}">
          @csrf
          @method('PUT')

          {{-- Photo --}}
          <div class="mb-4">
            <label class="form-label fw-bold text-muted">Photo</label><br>
            <div class="position-relative d-inline-block">
              <div class="rounded-circle d-flex justify-content-center align-items-center" style="width: 60px; height: 60px; background-color: #ccc; color: white; font-weight: bold;">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
              </div>
              <i class="bi bi-camera position-absolute bottom-0 end-0 bg-dark text-white rounded-circle p-1" style="font-size: 12px;" onclick="changePhoto()"></i> <!-- Icône de caméra -->
            </div>
          </div>

          {{-- Champs utilisateur --}}
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Nom</label>
              <input type="text" name="nom" class="form-control" value="{{ Auth::user()->last_name }}" style="border: 1px solid #3d0072;">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Prénom</label>
              <input type="text" name="prenom" class="form-control" value="{{ Auth::user()->first_name }}" style="border: 1px solid #3d0072;">
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" style="border: 1px solid #3d0072;">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Numéro de téléphone</label>
              <input type="text" name="telephone" class="form-control" value="{{ Auth::user()->phone }}" style="border: 1px solid #3d0072;">
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Date de création</label>
              <input type="text" class="form-control" value="{{ Auth::user()->created_at->format('d/m/y H:i') }}" disabled style="border: 1px solid #ccc;">
            </div>
          </div>

          {{-- Mot de passe --}}
          <div class="row mt-4">
            <div class="col-md-4 mb-3">
              <label class="form-label">Ancien mot de passe</label>
              <input type="password" name="old_password" class="form-control" style="border: 1px solid #3d0072;">
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Nouveau mot de passe</label>
              <input type="password" name="new_password" class="form-control" style="border: 1px solid #3d0072;">
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Confirmer le nouveau mot de passe</label>
              <input type="password" name="new_password_confirmation" class="form-control" style="border: 1px solid #3d0072;">
            </div>
          </div>

          {{-- Boutons --}}
          <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-dark me-2">Annuler</a>
            <button type="submit" class="btn" style="background-color: #3d0072; color: white;">Sauvegarder</button>
          </div>
        </form>

      </div>
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
<style>
    #navbar {
    display: none;
    }

</style>
@endsection
