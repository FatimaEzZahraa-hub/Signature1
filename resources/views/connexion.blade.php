<!-- resources/views/connexion.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion - EduSign</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Urbanist', sans-serif;
      background: linear-gradient(to right, #f5f5ff, #f9f9ff);
    }
    .link-purple {
      color: #4b0082;
    }
    .link-purple:hover {
      text-decoration: underline;
    }
    .btn-purple {
      background-color: #4b0082;
      border: none;
      color: white;
      padding: 10px;
      border-radius: 15px;
      transition: 0.3s;
    }
    .btn-purple:hover {
      background-color: #5f1aa5;
    }
    .navbar a.nav-link {
      margin-left: 15px;
      transition: 0.3s;
    }
    .navbar a.nav-link:hover {
      transform: scale(1.05);
      color: #5f1aa5;
    }
    .card {
      animation: fadeInUp 0.6s ease-in-out;
    }
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
      .btn-purple {
      background-color: #4b0082;
      border: none;
      color: white;
      padding: 10px;
      border-radius: 15px;
      transition: background-color 0.4s;
    }

    .btn-purple:hover {
      background-color: #8F87F1;
      color: #1f0c2d;
    }
  </style>
</head>
<body>

  <!-- ✅ Navbar améliorée -->
  <nav class="navbar navbar-light" style="background-color: rgb(255, 255, 255); border-bottom: 1px solid #ccc;">
  <div class="container">
    <a class="navbar-brand fw-bold" style="color: #4b0082;" href="{{ url('/') }}">
      <img src="{{ asset('images/EDUTRUSTSIGN (3).svg') }}" alt="Logo" width="30" height="30" class="me-2">EduTrustSign
    </a>
    <div class="d-flex">
      <a href="/" class="nav-link link-purple" style="margin-right: 10px;">Home</a>
      <a href="#" class="nav-link link-purple" style="margin-right: 10px;">FAQ</a>
      <a href="#" class="nav-link link-purple">Contactez-nous</a>
    </div>
  </div>
</nav>

  <!-- ✅ Contenu -->
  <main class="py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card shadow-lg border-0">
            <div class="card-body p-4">
              <h3 class="text-center mb-4" style="color: #4b0082;">Connexion</h3>

              <div class="row">
                <!-- Formulaire -->
                <div class="col-md-6">
                <form method="POST" action="{{ url('/connexion') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Adresse e-mail</label>
                    <input type="email" name="email" class="form-control" id="email" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Se souvenir de moi</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="link-purple">Mot de passe oublié ?</a>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-purple">Se connecter</button>
                </div>
                </form>

                </div>

                <!-- Image à droite -->
                <div class="col-md-6 d-none d-md-block">
                  <img src="{{ asset('images/undraw_login_weas.svg') }}" alt="Illustration" class="img-fluid rounded" />
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- ✅ Footer -->
  <footer class="text-center py-3" style="background-color: #4b0082; border-top: 1px solid #ccc; color: white; margin-top: 41px;">
  <small>© {{ date('Y') }} EduSign | Connexion sécurisée</small>
</footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
