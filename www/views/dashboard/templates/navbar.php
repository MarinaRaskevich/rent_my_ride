<ul class="nav flex-column">
    <li class="nav-item <?= $sectionName === 'Accueil' ? 'navbar_home' : '' ?> py-1">
        <a class="nav-link" href="?page=dashboard/home"><i class="bi bi-house-door me-1"></i>Home</a>
    </li>
    <li class="nav-item <?= $sectionName === 'Catégorie' ? 'navbar_home' : '' ?> py-1">
        <a class="nav-link" href="?page=categories/list"><i class="bi bi-file-earmark-text me-1"></i>Catégories</a>
    </li>
    <li class="nav-item <?= $sectionName === 'Véhicules' ? 'navbar_home' : '' ?> py-1">
        <a class="nav-link" href="?page=vehicles/list"><i class="bi bi-car-front-fill me-1"></i>Véhicules</a>
    </li>
    <li class="nav-item  <?= $sectionName === 'Réservations' ? 'navbar_home' : '' ?> py-1">
        <a class="nav-link" href="?page=rents/list"><i class="bi bi-calendar3 me-1"></i>Réservations</a>
    </li>
    <li class="nav-item <?= $sectionName === 'Clients' ? 'navbar_home' : '' ?> py-1">
        <a class="nav-link" href="?page=clients/list"><i class="bi bi-person me-1"></i>Clients</a>
    </li>
</ul>