<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'EduSign' }}</title>
  

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  
  <style>
    body {
      font-family: 'Urbanist', sans-serif;
      background-color: #f8f9fa;
      color: #333;
      padding-top: 80px; /* ou une valeur plus adaptée à la hauteur de ta navbar */
    }

    :root {
      --indigo: #4b0082;
    }

    .lead {
        font-size: 1rem;
    }
    .lawn{
        color: var(--indigo);
    }

    .navbar {
        background-color: #fff;
        border-bottom: 1px solid #ddd;
    }

    .navbar a,
    .navbar .btn {
        color: var(--indigo) !important;
    }

    .navbar .btn-outline-light {
        border-color: var(--indigo);
        color: var(--indigo);
    }

    .navbar .btn-outline-light:hover {
        background-color: var(--indigo);
        color: #fff;
    }

    .section-title {
      font-size: 2rem;
      font-weight: bold;
      color: var(--indigo);
      margin-bottom: 20px;
    }

    .btn-primary {
      background-color: var(--indigo);
      border-color: var(--indigo);
    }

    .btn-outline-secondary {
      border-color: var(--indigo);
      color: var(--indigo);
    }

    .btn-outline-secondary:hover {
      background-color: var(--indigo);
      color: #fff;
    }
    /* Effet hover pour les blocs */
    .p-4:hover {
        background-color: #f0f0f0; /* Couleur de fond plus claire au survol */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); /* Ombre plus marquée */
        transform: translateY(-5px); /* Légère montée du bloc */
        transition: all 0.3s ease; /* Transition fluide */
    }

    .p-4 h4 {
        transition: color 0.3s ease; /* Transition pour la couleur du titre */
    }

    /* Effet hover pour le titre */
    .p-4:hover h4 {
        color: #4b0082; /* Couleur violette pour le titre */
    }

  </style>

</head>
<body>

  <!-- ✅ Navbar -->
  <nav class="navbar navbar-expand-lg shadow-sm fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">
      <img src="{{ asset('images/EDUTRUSTSIGN (3).svg') }}" alt="Logo" width="30" height="30" class="me-2">
      EduTrustSign
    </a>
    <div>
      <a href="/login" class="btn btn-outline-light border-white fw-semibold px-4 py-2 rounded-pill me-2" style="transition: 0.3s;">
        <i class="bi bi-box-arrow-in-right me-2"></i> Se connecter
      </a>
      <a href="#aide" class="btn btn-outline-light">
      <img src="URL_DE_L_ICONE" alt="Icone">Connexion
      </a>
      
    </div>
  </div>
  </nav>


  <!-- ✅ Contenu -->
  <main>
    @yield('content')
  </main>

  <!-- ✅ Footer -->
  <footer class="py-4 bg-dark text-white text-center">
    <div class="container">
      <p class="mb-0">© 2025 EduSign. Plateforme de signature numérique pour le secteur éducatif.</p>
    </div>
  </footer>

</body>
</html>
