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
        <div class="container top d-flex justify-content-between align-items-center px-3">
            <a class="brand d-flex align-items-center" href="?page=home">
                <img class="logo" src="/public/assets/img/car.png" alt="logo">
                <p class="brandName ms-2 mb-0">Rent My Ride</p>
            </a>
            <a class="btn d-lg-none"><i class="bi bi-search"></i></a>
            <div class="position-relative d-none d-lg-block">
                <input id="search" type="search" class="form-control rounded" placeholder="Rechercher" />
                <div id="searchResults" class="text-decoration-none text-center"></div>
            </div>
            <div class="access">
                <a href="?page=dashboard/home" class="d-flex align-items-center justify-content-end">
                    <img class="access_avatar" src="/public/assets/img/default-avatar.png" alt="">
                    <div class="access_data ms-2 d-none d-lg-block">
                        <p class="mb-0"><span>Se connecter</span></p>
                        <!-- <p class="mb-0">Admin</p> -->
                    </div>
                </a>
            </div>
        </div>
    </header>
    <main class="bg-secondary-subtle">
        <?= $content ?>
    </main>
    <footer class="bg-secondary">
        <div class="py-4 text-white text-center">
            <p>Rent My Ride</p>
            <span>&copy; <?= date('Y') ?> AC</span>
        </div>
    </footer>
    <?php if (!empty($script)) : ?>
        <script src="/public/assets/js/<?= $script ?>.js"></script>
    <?php endif; ?>
    <script src="/public/assets/js/search.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>