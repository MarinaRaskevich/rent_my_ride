<?php ob_start(); ?>
<div class="container-fluid">
    <div class="row">
        <?php include __DIR__ . '/../templates/navbar.php'; ?>
        <div class="col-12 col-lg-10 pt-3" id="content">
            <?php include __DIR__ . '/../../partials/message.php'; ?>
            <?php include __DIR__ . '/../../partials/dialog.php'; ?>
            <div class="tableDashboard">
                <table>
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th><a href="?page=vehicles/list&column=brand&order=<?= ($order == 'DESC') ? 'ASC' : 'DESC' ?>">Marque <i class="bi bi-sort-alpha-down<?= ($order == 'DESC') ? '' : '-alt' ?> fs-5"></i></a></th>
                            <th>Modèle</th>
                            <th>Immatriculation</th>
                            <th>Kilométrage</th>
                            <th>Prix</th>
                            <th><a href="?page=vehicles/list&column=name&order=<?= ($order == 'DESC') ? 'ASC' : 'DESC' ?>">Catégorie <i class="bi bi-sort-alpha-down<?= ($order == 'DESC') ? '' : '-alt' ?> fs-5"></a></th>
                            <th colspan="2"><a href="?page=vehicles/add"><i class="bi bi-plus-lg fs-4"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vehiclesList as $vehicle) {
                            if (empty($vehicle->deleted_at)) {
                        ?>
                                <tr>
                                    <td class="img-cell">
                                        <div><img class="w-100" src="/public/uploads/<?= $vehicle->picture ?>" alt="voiture"></div>
                                    </td>
                                    <td><?= $vehicle->brand ?></td>
                                    <td><?= $vehicle->model ?></td>
                                    <td><?= $vehicle->registration ?></td>
                                    <td><?= $vehicle->mileage ?></td>
                                    <td><?= $vehicle->price ?></td>
                                    <td><?= $vehicle->categoryName ?></td>
                                    <td><a href="?page=vehicles/update&id=<?= $vehicle->id_vehicle ?>"><i class="bi bi-pencil text-black fs-6"></i></td>
                                    <td>
                                        <form class="modal-form" data-name="<?= $vehicle->brand . ' ' . $vehicle->model ?>" action="?page=vehicles/delete" method="post">
                                            <input type="hidden" name="id_vehicle" value="<?= $vehicle->id_vehicle ?>">
                                            <button type="submit" class="border-0 bg-secondary-subtle"><i class="bi bi-trash3 fs-6"></i></button>
                                        </form>
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