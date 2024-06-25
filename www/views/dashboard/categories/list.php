<?php ob_start(); ?>
<div class="container-fluid">
    <div class="row h-100">
        <div class="col-2 bg-white">
            <?php include __DIR__ . '/../templates/navbar.php'; ?>
        </div>
        <div class="col-10" id="content">
            <div class="categoryList w-100 d-flex justify-content-center">
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th colspan="2"> <a href="?page=categories/add" class="text-black"><i class="bi bi-plus-lg"></i></th>
                        </tr>
                    </thead>
                    <?php foreach ($categoryList as $category) { ?>
                        <tr>
                            <td><?= $category['name'] ?></td>
                            <td><a href="?page=categories/update&id=<?= $category['id_category'] ?>" class="text-black"><i class="bi bi-pencil"></i></a>
                            </td>
                            <td>
                                <!-- Button trigger modal -->
                                <a type="button" data-bs-toggle="modal" data-bs-target="#deleteConfirm<?= $category['id_category'] ?>">
                                    <i class="bi bi-trash3"></i></a>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteConfirm<?= $category['id_category'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteConfirmLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body mb-2">
                                                Êtes-vous sûr de vouloir supprimer cette catégorie?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                <a type="button" class="btn btn-primary" href="?page=categories/delete&id=<?= $category['id_category'] ?>">Supprimer</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>