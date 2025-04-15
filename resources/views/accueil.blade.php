<!-- resources/views/accueil.blade.php -->
@extends('layouts.app')

@section('content')

<section class="hero py-5 bg-white">
  <div class="container">
    <div class="row align-items-center">
      <!-- Image à gauche -->
      <div class="col-md-6 text-center text-md-start">
        <h1><span class="lawn">EduTrustSign </span>: Sécurisez et signez vos documents en toute <span class="lawn">confiance.</span></h1>
        <br>
        <p class="lead">
            EduTrustSign, plateforme de signature électronique dédiée au secteur éducatif, constitue une solution complète et sécurisée pour la gestion, la validation et l’authentification des documents académiques et administratifs. Conçue pour répondre aux exigences des établissements scolaires et universitaires, cette solution permet aux étudiants, enseignants et personnels administratifs de signer électroniquement leurs documents, d’émettre des demandes officielles et de vérifier la légitimité des pièces transmises, tout en assurant une traçabilité rigoureuse.
            <br><br>
            Grâce à une interface conviviale et ergonomique, EduTrustSign offre une expérience optimisée qui facilite le traitement des procédures documentaires de manière rapide et fiable. Ainsi, l’ensemble des démarches se réalise en ligne, éliminant la nécessité d’imprimer ou de se déplacer, et garantissant ainsi une gestion documentaire moderne et efficiente.
        </p>
        <center><a href="/login" class="btn btn-primary btn-lg">Se connecter</a></center>
      </div>
      <!-- Texte à droite -->
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="{{ asset('images/2.png') }}" alt="Bannière EduTrustSign" class="img-fluid rounded" />
      </div>
    </div>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container">
    <h2 class="section-title text-center">Fonctionnalités Clés</h2>
    <div class="row g-4 mt-4">
      <div class="col-md-3">
        <div class="p-4 bg-white rounded shadow-sm h-100">
          <h4>Signature Rapide</h4>
          <p>Signez vos documents en quelques clics, directement depuis votre navigateur.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="p-4 bg-white rounded shadow-sm h-100">
          <h4>Suivi en Temps Réel</h4>
          <p>Visualisez l’état de vos documents et parapheurs en temps réel.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="p-4 bg-white rounded shadow-sm h-100">
          <h4>Sécurité Avancée</h4>
          <p>Authentification forte, cryptage des données et journal d’audit complet.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="p-4 bg-white rounded shadow-sm h-100">
          <h4>Accessibilité Multi-Plateforme</h4>
          <p>Accédez à la plateforme depuis n’importe quel appareil : smartphone, tablette ou PC.</p>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="py-5 bg-white">
  <div class="container">
    <h2 class="section-title text-center">Pour Qui ?</h2>
    <div class="row g-4 mt-4">
      <div class="col-md-4">
        <div class="p-4 bg-light rounded shadow-sm h-100">
          <h4>🏫 Administration</h4>
          <p>Gérez les signatures, organisez des parapheurs et supervisez l’ensemble des opérations administratives.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="p-4 bg-light rounded shadow-sm h-100">
          <h4>👩‍🏫 Enseignants</h4>
          <p>Envoyez des documents officiels, signez rapidement et suivez l’évolution des demandes de signature.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="p-4 bg-light rounded shadow-sm h-100">
          <h4>👨‍🎓 Étudiants</h4>
          <p>Recevez et consultez vos certificats, bulletins et autres documents importants directement en ligne.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="aide" class="py-5 bg-light text-center">
  <div class="container">
    <h2 class="section-title">Besoin d’aide ?</h2>
    <p>Accédez à notre documentation, nos vidéos tutoriels et notre FAQ pour bien démarrer.</p>
    <a href="/aide" class="btn btn-outline-secondary">Voir la documentation</a>
  </div>
</section>
@endsection
