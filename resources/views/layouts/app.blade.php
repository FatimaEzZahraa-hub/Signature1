<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'EduSign' }}</title>
  
  <!-- le script qui active le menu responsive de Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  
  @stack('styles')
  
  <style>
    body {
      font-family: 'Urbanist', sans-serif;
      background-color: #f8f9fa;
      color: #333;
      padding-top: 60px;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    main {
      flex: 1;
      padding-bottom: 60px; /* Espace pour le footer */
    }

    footer {
      background-color: #fff;
      border-top: 1px solid #ddd;
      padding: 20px 0;
      margin-top: auto;
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
            .btn-outline-light {
        margin-left: 10px;
        }

        .btn-outline-light img {
        width: 18px;
        margin-right: 5px;
        }

        .btn-outline-light:hover {
        background-color: #4b0082 !important;
        color: white !important;
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
    .p-4:hover:not(.account-page *) {
        background-color: #f0f0f0;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        transform: translateY(-5px);
        transition: all 0.3s ease;
    }

    .p-4 h4 {
        transition: color 0.3s ease; /* Transition pour la couleur du titre */
    }

    /* Effet hover pour le titre */
    .p-4:hover h4 {
        color: #4b0082; /* Couleur violette pour le titre */
    }


    /* Bouton burger personnalisé */
  .navbar-toggler {
    border: none;
    outline: none;
    position: relative;
    z-index: 999;
  }

  .navbar-toggler-icon {
    background-image: none;
    width: 30px;
    height: 3px;
    background-color: #4b0082;
    display: block;
    position: relative;
    transition: all 0.3s ease-in-out;
  }

  .navbar-toggler-icon::before,
  .navbar-toggler-icon::after {
    content: "";
    width: 30px;
    height: 3px;
    background-color: #4b0082;
    position: absolute;
    left: 0;
    transition: all 0.3s ease-in-out;
  }

  .navbar-toggler-icon::before {
    top: -10px;
  }

  .navbar-toggler-icon::after {
    top: 10px;
  }

  /* Quand le menu est ouvert, on transforme les 3 barres en X */
  .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon {
    background-color: transparent;
  }

  .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon::before {
    transform: rotate(45deg);
    top: 0;
  }

  .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon::after {
    transform: rotate(-45deg);
    top: 0;
  }

  /* Hover effet doux sur boutons */
  .btn:not(.account-page *) {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .btn:hover:not(.account-page *) {
    transform: scale(1.05);
    box-shadow: 0 6px 12px rgba(0,0,0,0.15);
  }

  .navbar-nav .nav-link {
    color: var(--indigo);
    font-weight: 500;
    position: relative;
    transition: all 0.3s ease;
  }

  .navbar-nav .nav-link::after {
    content: '';
    position: absolute;
    width: 0%;
    height: 2px;
    bottom: 0;
    left: 0;
    background-color: var(--indigo);
    transition: 0.3s ease;
  }

  .navbar-nav .nav-link:hover::after {
    width: 100%;
  }

  /* Bouton violet de base */
  .btn-primary {
    background-color: var(--indigo);
    border-color: var(--indigo);
    transition: all 0.3s ease;
  }

  /* Hover moutarde */
  .btn-primary:hover {
    background-color: #e1b300 !important;
    border-color: #e1b300 !important;
    color: var(--indigo) !important;
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

    <!-- ✅ Bouton burger -->
    <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNavbar" aria-controls="menuNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- ✅ Liens du menu -->
    <div class="collapse navbar-collapse justify-content-end" id="menuNavbar">
      <div class="navbar-nav">
        <a class="nav-link" href="#Acceuil">Accueil</a>
        <a class="nav-link" href="#FAQ">FAQ</a>
        <a class="nav-link" href="#Contactez-nous">Contactez-nous</a>
        <a class="btn btn-outline-light ms-2" href="/connexion">Connexion</a>
      </div>
    </div>
  </div>
  </nav>



  <!-- ✅ Contenu -->
  <main>
    @yield('content')
  </main>

  <!-- ✅ Footer -->
  <footer class="footer mt-auto py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <p class="mb-0">&copy; {{ date('Y') }} EduTrustSign. Tous droits réservés.</p>
        </div>
        <div class="col-md-6 text-md-end">
          <a href="#" class="text-decoration-none me-3">Mentions légales</a>
          <a href="#" class="text-decoration-none me-3">Politique de confidentialité</a>
          <a href="#" class="text-decoration-none">Contact</a>
        </div>
      </div>
    </div>
  </footer>

    <!-- JavaScript pour animations -->
<script>
  // Fade + slide up à l'affichage
  document.addEventListener("DOMContentLoaded", function () {
    const elements = document.querySelectorAll("section");

    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add("animate");
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });

    elements.forEach(el => {
      el.classList.add("before-animate");
      observer.observe(el);
    });
  });
  window.addEventListener('DOMContentLoaded', () => {
    const navHeight = document.querySelector('.navbar').offsetHeight;
    document.body.style.paddingTop = navHeight + 'px';
  });

</script>

<style>
  .before-animate {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.6s ease-in-out;
  }

  .animate {
    opacity: 1;
    transform: translateY(0);
  }

  /* Animation texte Hero */
  .hero h1 {
    opacity: 0;
    transform: translateX(-30px);
    animation: slideIn 1s ease-out forwards;
    animation-delay: 0.3s;
  }

  .hero p {
    opacity: 0;
    transform: translateX(-30px);
    animation: slideIn 1s ease-out forwards;
    animation-delay: 0.6s;
  }

  @keyframes slideIn {
    to {
      opacity: 1;
      transform: translateX(0);
    }
  }

  /* Hover effet doux sur boutons */
  .btn:not(.account-page *) {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .btn:hover:not(.account-page *) {
    transform: scale(1.05);
    box-shadow: 0 6px 12px rgba(0,0,0,0.15);
  }

  .navbar-nav .nav-link {
    color: var(--indigo);
    font-weight: 500;
    position: relative;
    transition: all 0.3s ease;
  }

  .navbar-nav .nav-link::after {
    content: '';
    position: absolute;
    width: 0%;
    height: 2px;
    bottom: 0;
    left: 0;
    background-color: var(--indigo);
    transition: 0.3s ease;
  }

  .navbar-nav .nav-link:hover::after {
    width: 100%;
  }

  /* Bouton violet de base */
  .btn-primary {
    background-color: var(--indigo);
    border-color: var(--indigo);
    transition: all 0.3s ease;
  }

  /* Hover moutarde */
  .btn-primary:hover {
    background-color: #e1b300 !important;
    border-color: #e1b300 !important;
    color: var(--indigo) !important;
  }

</style>


</body>
</html>