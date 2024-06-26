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
                            <th>Client</th>
                            <th>Date de création</th>
                            <th>Date dé confirmation</th>
                            <th></th>
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
                                <td><?= $rent['clientName'] ?></td>
                                <td><?= $rent['created_at'] ?></td>
                                <td><?= $rent['confirmed_at'] ?></td>
                                <th></th>
                                <th></th>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>