<?php ob_start(); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-2 bg-white">
            <?php include __DIR__ . '/../templates/navbar.php'; ?>
        </div>
        <div class="col-10 pt-3" id="content">
            <?php include __DIR__ . '/../../partials/message.php'; ?>
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
                            <th colspan="2"><a href="?page=vehicles/add"><i class="bi bi-plus-lg fs-4"></i></th>
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
                                    <td><a href="?page=vehicles/update&id=<?= $vehicle['id_vehicle'] ?>"><i class="bi bi-pencil text-black fs-6"></i></td>
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
                                                        <a type="button" class="btn btn-primary" href="?page=vehicles/delete&id=<?= $vehicle['id_vehicle'] ?>">Supprimer</a>
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