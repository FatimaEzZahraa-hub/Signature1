@extends('layouts.app')

@section('content')
<section class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-lg">
          <div class="card-body">
            <h3 class="text-center mb-4" style="color: #4b0082;">Connexion</h3>

            <div class="row">
              <!-- Formulaire -->
              <div class="col-md-6">
                <form method="POST" action="{{ route('login') }}">
                  @csrf

                  <!-- Email -->
                  <div class="mb-3">
                    <label for="email" class="form-label">Adresse e-mail</label>
                    <input type="email" name="email" class="form-control" id="email" required autofocus style="background-color: #f5f5f5; border-color: #4b0082;">
                  </div>

                  <!-- Mot de passe -->
                  <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" id="password" required style="background-color: #f5f5f5; border-color: #4b0082;">
                  </div>

                  <!-- Options: Se souvenir + Mot de passe oublié -->
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                      <input type="checkbox" name="remember" class="form-check-input" id="remember">
                      <label class="form-check-label" for="remember">Se souvenir de moi</label>
                    </div>
                    <a href="{{ route('password.request') }}" style="color: #4b0082;">Mot de passe oublié ?</a>
                  </div>

                  <!-- Bouton connexion -->
                  <div class="d-grid">
                    <button type="submit" class="btn btn-primary" style="border-radius: 15px";>Se connecter</button>
                  </div>

                  <!-- Lien inscription -->
                  <div class="text-center mt-4">
                    <p>Pas encore de compte ? <a href="{{ route('register') }}" style="color: #4b0082;">Créer un compte</a></p>
                  </div>
                </form>
              </div>

              <!-- Image à droite -->
              <div class="col-md-6 d-none d-md-block">
                <img src="{{ asset('images/undraw_login_weas.svg') }}" alt="Image" class="img-fluid rounded" />
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
