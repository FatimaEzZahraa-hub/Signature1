<!-- resources/views/admin-sidebar.blade.php -->
<div class="sidebar" id="sidebar">
    <button class="toggle-btn" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </button>
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="bi bi-house"></i> <span>Accueil</span>
    </a>
    <a href="{{ route('admin.etudiants.index') }}" class="{{ request()->routeIs('admin.etudiants.*') ? 'active' : '' }}">
        <i class="bi bi-people"></i> <span>Étudiants</span>
    </a>
    <a href="{{ route('admin.enseignants.index') }}" class="{{ request()->routeIs('admin.enseignants.*') ? 'active' : '' }}">
        <i class="bi bi-person-badge"></i> <span>Enseignants</span>
    </a>
    <a href="{{ route('admin.activites') }}" class="{{ request()->routeIs('admin.activites') ? 'active' : '' }}">
        <i class="bi bi-activity"></i> <span>Activités</span>
    </a>
    <a href="{{ route('admin.documents.index') }}" class="{{ request()->routeIs('admin.documents.*') ? 'active' : '' }}">
        <i class="bi bi-file-earmark"></i> <span>Documents</span>
    </a>
    <a href="{{ route('admin.parapheurs.index') }}" class="{{ request()->routeIs('admin.parapheurs.*') ? 'active' : '' }}">
        <i class="bi bi-journal-check"></i> <span>Parapheurs</span>
    </a>
    <a href="{{ route('admin.contacts.index') }}" class="{{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
        <i class="bi bi-person-lines-fill"></i> <span>Contacts</span>
    </a>
    <a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">
        <i class="bi bi-gear"></i> <span>Paramètres</span>
    </a>
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

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    
    sidebar.classList.toggle('collapsed');
    
    if (sidebar.classList.contains('collapsed')) {
        content.style.marginLeft = '60px';
    } else {
        content.style.marginLeft = '220px';
    }
}
</script> 