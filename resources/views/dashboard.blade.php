<!-- resources/views/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - EduSign</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Urbanist', sans-serif;
      background-color: #f8f9fa;
      margin: 0;
    }

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

    .content {
      margin-left: 220px;
      transition: margin-left 0.3s;
      padding: 30px;
    }

    .content-full {
      margin-left: 0;
    }

    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      padding: 10px 20px;
      background-color: #fff;
      border-radius: 10px;
    }

    .user-circle {
      background-color: #3d0072;
      color: white;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      font-weight: bold;
      text-decoration: none;
    }

    .section {
      margin-top: 30px;
    }

    .section h5 {
      border-bottom: 1px solid #ccc;
      padding-bottom: 5px;
      font-weight: 600;
      margin-bottom: 15px;
    }

    .shortcut {
      display: inline-block;
      margin-right: 20px;
      color: #3d0072;
      text-decoration: none;
    }

    .shortcut i {
      margin-right: 5px;
    }

    .toggle-btn {
        background: none;
        border: none;
        color: white;
        font-size: 24px;
        cursor: pointer;
        padding: 15px 20px;
        width: 100%;
        text-align: left;
        position: sticky;
        top: 0;
        z-index: 1100;
    }
    
    .empty-card {
      border: 1px dashed #ccc;
      border-radius: 15px;
      text-align: center;
      padding: 40px;
      background-color: #fff;
      color: #888;
      font-size: 16px;
    }

    @media (max-width: 768px) {
      .sidebar {
        position: absolute;
        height: 100%;
      }
      .content {
        margin-left: 0;
      }
    }
  </style>
</head>
<body>

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
  

  <!-- ✅ Contenu principal -->
  <div class="content" id="content">
    <div class="topbar">
      <div class="d-flex align-items-center">
        <div>
          <h5 class="mb-1">Bonjour XXXXXXXXXXXX !</h5>
        </div>
      </div>
      <a href="#" class="user-circle">FZ</a>
    </div>

    <!-- Sections -->
    <div class="section">
        <a href="#" class="shortcut"><i class="bi bi-folder-plus"></i> Nouveau parapheur</a>
        <a href="#" class="shortcut"><i class="bi bi-person-plus-fill"></i> Nouveau contact</a>
        
    </div>
    <div class="section">
      <h5>Parapheurs</h5>
      <div class="empty-card">Aucun parapheur</div>
    </div>

    <div class="section">
      <h5>Contacts</h5>
      <div class="empty-card">Aucun contact</div>
    </div>

    <div class="section">
      <h5>Documents</h5>
      <div class="empty-card">Aucun document</div>
    </div>
  </div>

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
  

</body>
</html>
