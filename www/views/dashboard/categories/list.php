<?php ob_start(); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-lg-2 bg-white pb-2">
            <?php include __DIR__ . '/../templates/navbar.php'; ?>
        </div>
        <div class="col-12 col-lg-10 pt-3" id="content">
            <?php include __DIR__ . '/../../partials/message.php'; ?>
            <?php include __DIR__ . '/../../partials/dialog.php'; ?>
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
                                <form class="modal-form" data-name="<?= $category['name'] ?>" action="?page=categories/delete" method="post">
                                    <input type="hidden" name="id_category" value="<?= $category['id_category'] ?>">
                                    <button type="submit" class="border-0 bg-secondary-subtle"><i class="bi bi-trash3"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>