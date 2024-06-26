<?php ob_start(); ?>
<div class="hero">
    <div class="container d-flex flex-column justify-content-center align-items-end h-100">
        <p class="fs-3 text-white fw-bold text-end mb-1">La meilleure plateforme de</p>
        <p class="fs-3 text-white fw-bold text-end"> location de voitures</p>
    </div>
</div>
<div class="container-fluid">
    <div class="container py-5">
        <h1 class="text-center fs-3 fw-bold">Nos voitures</h3>
            <div class="sort mb-3">
                <p class="mb-0 text-secondary">Trier par:</p>
                <form method="post" class="d-flex w-25">
                    <select name="category" id="category" class="form-select me-2">
                        <option value="all">Toutes catégories</option>
                        <?php foreach ($categoryList as $category) {
                            $isSelected = ($category['id_category'] == $categoryId) ? 'selected' : ''; ?>
                            <option <?= $isSelected ?> value="<?= $category['id_category'] ?>"><?= $category['name'] ?></option>
                        <?php } ?>
                    </select>
                </form>
            </div>
            <div class="row g-3">
                <?php foreach ($vehiclesList as $vehicle) { ?>
                    <div class="col-3">
                        <div class="card shadow">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title"><?= $vehicle['brand'] . ' ' . $vehicle['model'] ?></h5>
                                    <h6 class="card-subtitle mb-2 text-body-secondary"><?= $vehicle['categoryName'] ?></h6>
                                </div>
                                <img src="/public/uploads/<?= $vehicle['picture'] ?>" alt="" class="w-100">
                                <div class="mt-4 d-flex justify-content-between align-items-center">
                                    <p class="mb-0 fw-bold">80€ / par jour</p>
                                    <a class="btn btn-primary" href="?page=vehicle/detail&id=<?= $vehicle['id_vehicle'] ?>">Réserver</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- Pagination -->
                <ul class="d-flex justify-content-between list-unstyled pt-2">
                    <li><a href="?page=home&part=<?= $currentPage - 1 ?>"><i class="bi bi-arrow-left fs-4 <?= ($currentPage == 1) ? "text-secondary" : "" ?>"></i></a></li>
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
                        <a href="?page=home&part=<?= $currentPage + 1 ?>" class="page-link"><i class="bi bi-arrow-right fs-4 <?= ($currentPage == $pages) ? "text-secondary" : "" ?>"></i></a>
                    </li>
                </ul>
            </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>