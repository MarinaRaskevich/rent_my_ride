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
                            <th>
                                <div class="dropdown">
                                    <a class="btn dropdown-toggle fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Status
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="?page=rents/list&status=incoming">à venir</a></li>
                                        <li><a class="dropdown-item" href="?page=rents/list&status=finished">passé</a></li>
                                        <li><a class="dropdown-item" href="?page=rents/list&status=inprogress">en cours</a></li>
                                        <li><a class="dropdown-item" href="?page=rents/list&status=all">toutes</a></li>
                                    </ul>
                                </div>
                            </th>
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
                                <td><?= $rent['status'] ?></td>
                                <th>
                                    <?php if (empty($rent['confirmed_at'])) { ?>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#<?= $rent['id_rent'] ?>">
                                            Confirmer
                                        </button>
                                    <?php } else { ?>
                                        <i class="bi bi-check-circle text-success"></i>
                                    <?php  } ?>
                                </th>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>