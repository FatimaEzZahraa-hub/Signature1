<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion - EduSign</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Urbanist', sans-serif;
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
  </style>
</head>
<body>

  {{-- Nav simplifiée pour connexion --}}
  <nav class="navbar navbar-light" style="background-color: rgb(255, 255, 255); border-bottom: 1px solid #ccc;">
    <div class="container">
      <a class="navbar-brand fw-bold" style="color: #4b0082;" href="{{ url('/') }}">
        <img src="{{ asset('images/EDUTRUSTSIGN (3).svg') }}" alt="Logo" width="30" height="30" class="me-2">EduTrustSign
      </a>
      <div class="d-flex">
        <a href="#" class="nav-link link-purple">Lien 1</a>
        <a href="#" class="nav-link link-purple">Lien 2</a>
        <a href="#" class="nav-link link-purple">Lien 3</a>
      </div>
    </div>
  </nav>

  <main class="py-4">
    @yield('content')
  </main>

  {{-- Footer spécifique connexion --}}
  <footer class="text-center py-3" style="background-color: #4b0082; border-top: 1px solid #ccc; color: white;">
    <small>© {{ date('Y') }} EduSign | Connexion sécurisée</small>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
