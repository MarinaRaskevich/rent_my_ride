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
            <div class="vehiclesList">
                <table>
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th><a href="?column=brand&order=<?= ($order == 'DESC') ? 'ASC' : 'DESC' ?>">Marque <i class="bi bi-sort-alpha-down<?= ($order == 'DESC') ? '' : '-alt' ?> fs-5"></i></a></th>
                            <th>Modèle</th>
                            <th>Numéro d'immat.</th>
                            <th>Kilométrage</th>
                            <th><a href="?column=name&order=<?= ($order == 'DESC') ? 'ASC' : 'DESC' ?>">Catégorie <i class="bi bi-sort-alpha-down<?= ($order == 'DESC') ? '' : '-alt' ?> fs-5"></a></th>
                            <th>Date de création</th>
                            <!-- <th>Date de modification</th> -->
                            <th colspan="2"><a href="/controllers/dashboard/vehicles/add-ctrl.php"><i class="bi bi-plus-lg fs-4"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vehiclesList as $vehicle) {
                            if (empty($vehicle['deleted_at'])) {
                        ?>
                                <tr>
                                    <td class="img-cell">
                                        <div><img class="w-100" src="/public/uploads/<?= $vehicle['picture'] ?>" alt="voiture"></div>
                                    </td>
                                    <td><?= $vehicle['brand'] ?></td>
                                    <td><?= $vehicle['model'] ?></td>
                                    <td><?= $vehicle['registration'] ?></td>
                                    <td><?= $vehicle['mileage'] ?></td>
                                    <td><?= $vehicle['name'] ?></td>
                                    <td><?= $vehicle['created_at'] ?></td>
                                    <!-- <td><?= $vehicle['updated_at'] ?></td> -->
                                    <td><a href="/controllers/dashboard/vehicles/update-ctrl.php?id=<?= $vehicle['id_vehicle'] ?>"><i class="bi bi-pencil text-black fs-6"></i></td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#deleteConfirm<?= $vehicle['id_vehicle'] ?>">
                                            <i class="bi bi-trash3 fs-6"></i></a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteConfirm<?= $vehicle['id_vehicle'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteConfirmLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body mb-2 fs-5">
                                                        Êtes-vous sûr de vouloir supprimer <?= $vehicle['brand'] . ' ' . $vehicle['model'] ?>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                        <a type="button" class="btn btn-primary" href="/controllers/dashboard/vehicles/delete-ctrl.php?id=<?= $vehicle['id_vehicle'] ?>">Supprimer</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>