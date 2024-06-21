<?php ob_start(); ?>
<div class="container-fluid">
    <div class="row h-100">
        <div class="col-2 bg-white">
            <ul class="nav flex-column">
                <li class="nav-item <?= $title === 'Accueil' ? 'navbar_home' : '' ?> py-1">
                    <a class="nav-link" href="/controllers/dashboard/home-ctrl.php"><i class="bi bi-house-door me-1"></i>Home</a>
                </li>
                <li class="nav-item <?= $title === 'Catégories' ? 'navbar_home' : '' ?> py-1">
                    <a class="nav-link" href="/controllers/dashboard/categories/list-ctrl.php"><i class="bi bi-file-earmark-text me-1"></i>Catégories</a>
                </li>
                <li class="nav-item <?= $title === 'Véhicules' ? 'navbar_home' : '' ?> py-1">
                    <a class="nav-link" href="/controllers/dashboard/vehicles/list-ctrl.php"><i class="bi bi-car-front-fill me-1"></i>Véhicules</a>
                </li>
                <li class="nav-item  <?= $title === 'Réservations' ? 'navbar_home' : '' ?> py-1">
                    <a class="nav-link" href=""><i class="bi bi-calendar3 me-1"></i>Réservations</a>
                </li>
                <li class="nav-item <?= $title === 'Clients' ? 'navbar_home' : '' ?> py-1">
                    <a class="nav-link" href=""><i class="bi bi-person me-1"></i>Clients</a>
                </li>
            </ul>
        </div>
        <div class="col-10" id="content">
            <div class="row h-100 d-flex justify-content-center align-items-center">
                <div class="col-8">
                    <form method="post">
                        <label for="name" class="form-label fw-bold mb-2">Entrez un nouveau nom de catégorie</label>
                        <input class="form-control" type="text" name="name" id="name" maxlength="50" value="<?= $category->name ?>">
                        <button type="submit" class="btn btn-primary mt-2">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>