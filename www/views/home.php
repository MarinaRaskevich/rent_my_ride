<?php ob_start(); ?>
<div class="hero">
    <div class="container d-flex flex-column justify-content-center align-items-end h-100">
        <p class="fs-3 fw-bold text-end mb-1 hero-text">La meilleure plateforme de</p>
        <p class="fs-3 fw-bold text-end hero-text"> location de voitures</p>
    </div>
</div>
<div class="container-fluid">
    <div class="container py-5">
        <h1 class="text-center fs-3 fw-bold">Nos voitures</h3>
            <div class="row g-3 mb-3">
                <div class="col-12 col-lg-3">
                    <p class="mb-0 text-secondary">Trier par:</p>
                    <form method="post">
                        <select name="category" id="category" class="form-select me-2">
                            <option value="0">Toutes catégories</option>
                            <?php foreach ($categoryList as $category) {
                                $isSelected = ($category['id_category'] == $categoryId) ? 'selected' : ''; ?>
                                <option <?= $isSelected ?> value="<?= $category['id_category'] ?>"><?= $category['name'] ?></option>
                            <?php } ?>
                        </select>
                    </form>
                </div>
            </div>
            <div class="row g-3">
                <?php foreach ($vehiclesList as $vehicle) { ?>
                    <div class="col-12 col-lg-3">
                        <div class="card shadow">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title"><?= $vehicle['brand'] . ' ' . $vehicle['model'] ?></h5>
                                    <h6 class="card-subtitle mb-2 text-body-secondary"><?= $vehicle['categoryName'] ?></h6>
                                </div>
                                <img src="/public/uploads/<?= $vehicle['picture'] ?>" alt="" class="w-100">
                                <div class="mt-4 d-flex justify-content-between align-items-center">
                                    <p class="mb-0 fw-bold"><?= $vehicle['price'] ?>€ / par jour</p>
                                    <a class="btn btn-primary" href="?page=vehicle/detail&id=<?= $vehicle['id_vehicle'] ?>">Réserver</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- Pagination -->
                <ul class="d-flex justify-content-between list-unstyled pt-2">
                    <li>
                        <?php if ($currentPage  == 1) { ?>
                            <i class="bi bi-arrow-left fs-4 text-secondary"></i>
                        <?php } else { ?>
                            <a href="?page=home&part=<?= $currentPage - 1 ?>"><i class="bi bi-arrow-left fs-4 text-black"></i></a>
                        <?php } ?>
                    </li>
                    <div class="d-flex justify-content-between align-items-center">
                        <?php for ($page = 1; $page <= $pages; $page++) { ?>
                            <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                            <li class="<?= ($currentPage == $page) ? "fw-bold fs-4" : "" ?>">
                                <a href="?page=home&part=<?= $page ?>" class="page-link"><?= $page ?></a>
                            </li>
                        <?php } ?>
                    </div>
                    <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                    <li>
                        <?php if ($currentPage  == $pages) { ?>
                            <i class="bi bi-arrow-right fs-4 text-secondary"></i>
                        <?php } else { ?>
                            <a href="?page=home&part=<?= $currentPage + 1 ?>" class="page-link"><i class="bi bi-arrow-right fs-4 text-black"></i></a>
                        <?php } ?>
                    </li>
                </ul>
            </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>