<?php ob_start(); ?>
<div class="container-fluid">
    <div class="row h-100">
        <div class="col-2 bg-white">
            <?php include __DIR__ . '/../templates/navbar.php'; ?>
        </div>
        <div class="col-10 pt-3" id="content">
            <div class="tableDashboard">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date de début</th>
                            <th>Date de fin</th>
                            <th>Véhicule</th>
                            <th>Immatriculation</th>
                            <th>Client</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rents as  $rent) { ?>
                            <tr>
                                <td><?= $rent['id_rent'] ?></td>
                                <td><?= $rent['startdate'] ?></td>
                                <td><?= $rent['enddate'] ?></td>
                                <td><?= $rent['vehicleName'] ?></td>
                                <td><?= $rent['registration'] ?></td>
                                <td><?= $rent['clientName'] ?></td>
                                <td><?php ?></td>
                                <th>
                                    <?php if (empty($rent['confirmed_at'])) { ?>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#<?= $rent['id_rent'] ?>">
                                            Confirmer
                                        </button>
                                    <?php } else { ?>
                                        <i class="bi bi-check-circle text-success"></i>
                                    <?php  } ?>
                                </th>
                                <!-- Button trigger modal -->


                                <!-- Modal -->
                                <div class="modal fade" id="<?= $rent['id_rent'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                ...
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>