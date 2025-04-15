<!-- profile.blade.php -->

<div id="profileMenu" class="position-fixed top-0 end-0 h-100 w-100" style="background-color: rgba(0, 0, 0, 0.2); display: none; z-index: 2000;">
  <div class="d-flex justify-content-end h-100">
    <div style="width: 300px; background-color: white; border-top-left-radius: 20px; border-bottom-left-radius: 20px; overflow: hidden;">
      
      <!-- Bande violette avec infos -->
      <div class="d-flex align-items-center p-3" style="background-color: #3d0072;">
        <div class="rounded-circle d-flex justify-content-center align-items-center me-2" style="width: 40px; height: 40px; background-color: #7a34b6; color: white; font-weight: bold;">
          {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
        </div>
        <div class="text-white" style="font-size: 13px;">
          {{ Auth::user()->name }}<br>
          {{ Auth::user()->email }}
        </div>
        <button onclick="toggleProfileMenu()" class="btn btn-sm btn-light ms-auto" style="border-radius: 50%; width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center;">
          <i class="bi bi-x"></i>
        </button>
      </div>

      <!-- Liens Mon compte / Déconnexion -->
      <div class="p-4">
        <a href="{{ route('account') }}" class="d-flex align-items-center text-decoration-none mb-4" style="color: #3d0072; font-weight: 500;">
          <i class="bi bi-person-fill me-3"></i> Mon compte
        </a>
        <form action="{{ route('logout') }}" method="POST" class="d-flex align-items-center text-decoration-none" style="color: #3d0072; font-weight: 500; padding: 0; margin: 0;">
          @csrf
          <button type="submit" style="background: none; border: none; color: #3d0072; font-weight: 500; padding: 0; width: 100%; text-align: left;">
            <i class="bi bi-box-arrow-right me-3"></i> Se déconnecter
          </button>
        </form>
      </div>

    </div>
  </div>
</div>

<script>
  function toggleProfileMenu() {
    const menu = document.getElementById('profileMenu');
    menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';
  }

  // Fermer si clic hors menu
  document.addEventListener('click', function(event) {
    const menu = document.getElementById('profileMenu');
    const userCircle = document.querySelector('.user-circle');
    if (!menu.contains(event.target) && !userCircle.contains(event.target)) {
      menu.style.display = 'none';
    }
  });

  document.querySelector('.user-circle').addEventListener('click', function(event) {
    event.stopPropagation();
    toggleProfileMenu();
  });
</script>