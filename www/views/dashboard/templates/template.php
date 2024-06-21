<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/assets/css/style.css">
    <title><?= $title ?? '' ?></title>
</head>

<body>
    <header>
        <div class="container top d-flex justify-content-between px-3">
            <div class="brand d-flex align-items-center">
                <a class="d-flex align-items-center" href="/controllers/home-ctrl.php">
                    <img class="logo" src="/public/assets/img/car.png" alt="logo">
                    <p class="brandName ms-2 mb-0">Rent My Ride</p>
                </a>
            </div>
            <div class="access d-flex align-items-center justify-content-end">
                <img class="access_avatar" src="/public/assets/img/default-avatar.png" alt="">
                <div class="access_data ms-2">
                    <p class="mb-0"><span>Username</span></p>
                    <p class="mb-0">Admin</p>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container-fluid">
            <div class="row h-100">
                <div class="col-2">
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
                <div class="col-10" id="content"> <?= $content ?></div>
            </div>
        </div>
    </main>
    <footer></footer>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>