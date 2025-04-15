<!-- resources/views/sidebar.blade.php -->
<!--
<div class="sidebar" id="sidebar">
  <button class="toggle-btn" onclick="toggleSidebar()">
    <i class="bi bi-list"></i>
  </button>
  <a href="#" class="active"><i class="bi bi-house"></i> <span>Accueil</span></a>
  <a href="#"><i class="bi bi-file-earmark"></i> <span>Documents</span></a>
  <a href="#"><i class="bi bi-journal-check"></i> <span>Parapheur</span></a>
  <a href="#"><i class="bi bi-inbox"></i> <span>Inbox</span></a>
  <a href="#"><i class="bi bi-person-lines-fill"></i> <span>Contacts</span></a>
  <a href="#"><i class="bi bi-question-circle"></i> <span>Aide</span></a>
</div>
-->
<!-- ✅ Sidebar -->
<div class="sidebar" id="sidebar">
    <button class="toggle-btn" onclick="toggleSidebar()">
      <i class="bi bi-list"></i>
    </button>
    <a href="#" class="active"><i class="bi bi-house"></i> <span>Accueil</span></a>
    <a href="#"><i class="bi bi-file-earmark"></i> <span>Documents</span></a>
    <a href="#"><i class="bi bi-journal-check"></i> <span>Parapheur</span></a>
    <a href="#"><i class="bi bi-inbox"></i> <span>Inbox</span></a>
    <a href="#"><i class="bi bi-person-lines-fill"></i> <span>Contacts</span></a>
    <a href="#"><i class="bi bi-question-circle"></i> <span>Aide</span></a>
</div>
<style>
.sidebar {
      width: 220px;
      height: 100vh;
      background-color: #3d0072;
      color: white;
      position: fixed;
      transition: transform 0.3s ease-in-out;
      z-index: 1000;
}

.sidebar a {
    color: white;
    display: block;
    padding: 15px 20px;
    text-decoration: none;
}

.sidebar a:hover,
.sidebar a.active {
    background-color: white;
    color: #3d0072;
    border-radius: 15px 0 0 15px;
}

.sidebar-hidden {
    transform: translateX(-100%);
}

.sidebar.collapsed {
width: 60px;
}

.sidebar.collapsed a span {
display: none;
}

.sidebar.collapsed .toggle-btn {
text-align: center;
padding: 15px 0;
}

.sidebar.collapsed a {
justify-content: center;
}
</style>

<!-- ✅ Script -->
<script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      const content = document.getElementById('content');
      
      sidebar.classList.toggle('collapsed');
      
      // Ajuste la marge du contenu selon la sidebar
      if (sidebar.classList.contains('collapsed')) {
        content.style.marginLeft = '60px';
      } else {
        content.style.marginLeft = '220px';
      }
    }
  </script>
  

  