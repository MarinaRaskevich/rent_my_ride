<!-- <ul class="nav flex-column">
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
</ul> -->

<button class="btn btn-primary filters-btn d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#filtersSideBar" aria-controls="offcanvasWithBothOptions">
    Dashboard menu </i>
</button>

<div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="filtersSideBar" aria-labelledby="offcanvasWithBothOptionsLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close d-lg-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav flex-column">
            <li class="nav-item <?= $sectionName === 'Accueil' ? 'navbar_home' : '' ?> p-1">
                <a class="nav-link" href="?page=dashboard/home"><i class="bi bi-house-door me-1"></i>Home</a>
            </li>
            <li class="nav-item <?= $sectionName === 'Catégorie' ? 'navbar_home' : '' ?> p-1">
                <a class="nav-link" href="?page=categories/list"><i class="bi bi-file-earmark-text me-1"></i>Catégories</a>
            </li>
            <li class="nav-item <?= $sectionName === 'Véhicules' ? 'navbar_home' : '' ?> p-1">
                <a class="nav-link" href="?page=vehicles/list"><i class="bi bi-car-front-fill me-1"></i>Véhicules</a>
            </li>
            <li class="nav-item  <?= $sectionName === 'Réservations' ? 'navbar_home' : '' ?> p-1">
                <a class="nav-link" href="?page=rents/list"><i class="bi bi-calendar3 me-1"></i>Réservations</a>
            </li>
        </ul>
    </div>
</div>

<script src="/public/assets/js/offcanvas.js"></script>