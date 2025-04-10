@props(['activeRoute' => ''])

<style>
    .sidebar {
        width: 220px;
        height: 100vh;
        background-color: #3d0072;
        color: white;
        position: fixed;
        transition: transform 0.3s ease-in-out;
        z-index: 1000;
        left: 0;
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
        transition: all 0.3s ease;
        padding: 30px;
        min-height: calc(100vh - 60px);
    }

    .content.collapsed {
        margin-left: 60px;
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

    .toggle-btn i {
        margin-right: 0;
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

<div class="sidebar" id="sidebar">
    <button class="toggle-btn" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </button>
    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="bi bi-house"></i> <span>Accueil</span>
    </a>
    <a href="{{ route('documents.index') }}" class="{{ request()->routeIs('documents.*') ? 'active' : '' }}">
        <i class="bi bi-file-earmark"></i> <span>Documents</span>
    </a>
    <a href="#"><i class="bi bi-journal-check"></i> <span>Parapheur</span></a>
    <a href="#"><i class="bi bi-inbox"></i> <span>Inbox</span></a>
    <a href="#"><i class="bi bi-person-lines-fill"></i> <span>Contacts</span></a>
    <a href="#"><i class="bi bi-question-circle"></i> <span>Aide</span></a>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        
        sidebar.classList.toggle('collapsed');
        content.classList.toggle('collapsed');
        
        // Sauvegarder l'état dans le localStorage
        const isCollapsed = sidebar.classList.contains('collapsed');
        localStorage.setItem('sidebarCollapsed', isCollapsed);
    }

    // Restaurer l'état de la sidebar au chargement de la page
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
        
        if (isCollapsed) {
            sidebar.classList.add('collapsed');
            content.classList.add('collapsed');
        }
    });
</script> 